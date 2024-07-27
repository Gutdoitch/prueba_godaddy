<?php
/**
 * ProductPrices.php
 *
 * @package   edd-multi-currency
 * @copyright Copyright (c) 2022, Easy Digital Downloads
 * @license   GPL2+
 * @since     1.0
 */

namespace EDD_Multi_Currency\Admin;

use EDD_Multi_Currency\Models\Currency;
use EDD_Multi_Currency\Models\Product;
use EDD_Multi_Currency\Utils\Currency as CurrencyUtil;

class ProductPrices {

	/**
	 * @var Product
	 */
	private $product;

	/**
	 * Displays single price options.
	 *
	 * @param int $productId
	 */
	public function displaySinglePrices( int $productId ) {
		try {
			if ( ! $this->product instanceof Product ) {
				$this->product = Product::fromId( $productId );
			}

			if ( $this->product->hasVariablePrices() ) {
				return;
			}

			$this->currencyFields();
		} catch ( \Exception $e ) {

		} catch ( \EDD_Exception $e ) {

		}
	}

	/**
	 * Displays variable prices.
	 *
	 * @since 1.0
	 *
	 * @param int   $productId
	 * @param int   $priceId
	 * @param array $args
	 */
	public function displayVariablePrices( int $productId, int $priceId, array $args ) {
		try {
			if ( ! $this->product instanceof Product ) {
				$this->product = Product::fromId( $productId );
			}

			if ( ! $this->product->hasVariablePrices() ) {
				return;
			}
			?>
			<div class="edd-custom-price-option-section">
				<span class="edd-custom-price-option-section-title">
					<?php esc_html_e( 'Custom Currency Prices', 'edd-multi-currency' ); ?>
				</span>

				<div class="edd-custom-price-option-section-content edd-form-row">
					<?php $this->currencyFields( $priceId ); ?>
				</div>
			</div>
			<?php
		} catch ( \Exception $e ) {

		} catch ( \EDD_Exception $e ) {

		}
	}

	/**
	 * Renders the currency fields.
	 * Shared between variable and non-variable pricing.
	 *
	 * @since 1.0
	 *
	 * @param int|null $priceId Variable price ID, if applicable. Should be `null` if product
	 *                          doesn't have variable prices.
	 *
	 * @throws \EDD_Exception
	 */
	private function currencyFields( $priceId = null ) {
		$currencies = Currency::query( [ 'number' => 9999 ] );
		if ( ! $currencies ) {
			?>
			<p>
				<?php _e( 'No currencies set yet.', 'edd-multi-currency' ); ?>
			</p>
			<?php
			return;
		}

		$isVariable = ! is_null( $priceId );
		$typeKey    = $isVariable ? Product::VARIATION_PRICES_KEY : Product::REGULAR_PRICE_KEY;
		$setPrices  = $this->product->getExplicitPrices( $typeKey );

		wp_nonce_field( 'edd_mc_save_product_currencies', 'edd_mc_save_product_currencies_nonce' );
		?>
		<div class="edd-multi-currency__currency-list">
			<?php
			foreach ( $currencies as $currency ) {
				/** @var Currency $currency */

				$fieldId = strtolower( $currency->currency );
				if ( $isVariable ) {
					$fieldId .= '-' . $priceId;
				}

				$fieldName = $isVariable ? Product::VARIATION_PRICES_KEY : Product::REGULAR_PRICE_KEY;
				if ( $isVariable ) {
					$fieldName .= '[' . esc_attr( $priceId ) . ']';
				}
				$fieldName .= '[' . esc_attr( $currency->currency ) . ']';

				$currentValue = '';
				if ( ! is_null( $priceId ) && isset( $setPrices[ $priceId ][ $currency->currency ] ) ) {
					$currentValue = $setPrices[ $priceId ][ $currency->currency ];
				} elseif ( is_null( $priceId ) && isset( $setPrices[ $currency->currency ] ) ) {
					$currentValue = $setPrices[ $currency->currency ];
				}
				?>
				<div class="edd-multi-currency__currency">
					<div class="edd-form-group">
						<label for="edd-multi-currency__currency-<?php echo esc_attr( $fieldId ); ?>" class="edd-form-group__label">
							<?php echo esc_html( $currency->currency ); ?>
						</label>
						<input
							type="text"
							id="edd-multi-currency__currency-<?php echo esc_attr( $fieldId ); ?>"
							class="edd-form-group__input edd-price-field"
							name="<?php echo esc_attr( $fieldName ); ?>"
							value="<?php echo esc_attr( $currentValue ); ?>"
							placeholder="<?php esc_attr_e( 'Auto', 'edd-multi-currency' ); ?>"
						>
					</div>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}

	/**
	 * Saves custom currency prices.
	 *
	 * @since 1.0
	 *
	 * @param int      $productId
	 * @param \WP_Post $post
	 */
	public function save( int $productId, \WP_Post $post ) {
		if ( empty( $_POST['edd_mc_save_product_currencies_nonce'] ) || ! wp_verify_nonce( $_POST['edd_mc_save_product_currencies_nonce'], 'edd_mc_save_product_currencies' ) ) {
			return;
		}

		try {
			$this->product = Product::fromId( $productId );

			$this->saveSinglePrice( $productId );
			$this->saveVariablePrice( $productId );
		} catch ( \Exception $e ) {

		} catch ( \EDD_Exception $e ) {

		}
	}

	/**
	 * Saves single prices.
	 *
	 * @since 1.0
	 *
	 * @param int $productId
	 *
	 * @throws \EDD_Exception
	 */
	private function saveSinglePrice( int $productId ) {
		if ( empty( $_POST[ Product::REGULAR_PRICE_KEY ] ) || ! is_array( $_POST[ Product::REGULAR_PRICE_KEY ] ) || $this->product->hasVariablePrices() ) {
			delete_post_meta( $productId, Product::REGULAR_PRICE_KEY );

			return;
		}

		$sanitizedPrices = $this->sanitizePrices( $_POST[ Product::REGULAR_PRICE_KEY ] );
		if ( ! empty( $sanitizedPrices ) ) {
			update_post_meta( $productId, Product::REGULAR_PRICE_KEY, json_encode( $sanitizedPrices ) );
		} else {
			delete_post_meta( $productId, Product::REGULAR_PRICE_KEY );
		}
	}

	/**
	 * Saves the variable prices.
	 *
	 * @since 1.0
	 *
	 * @param int $productId
	 *
	 * @throws \EDD_Exception
	 */
	private function saveVariablePrice( int $productId ) {
		if ( empty( $_POST[ Product::VARIATION_PRICES_KEY ] ) || ! is_array( $_POST[ Product::VARIATION_PRICES_KEY ] ) || ! $this->product->hasVariablePrices() ) {
			delete_post_meta( $productId, Product::VARIATION_PRICES_KEY );

			return;
		}

		$sanitizedPrices = [];
		foreach ( $_POST[ Product::VARIATION_PRICES_KEY ] as $priceId => $prices ) {
			$sanitizedPrice = $this->sanitizePrices( $prices );

			if ( ! empty( $sanitizedPrice ) ) {
				$sanitizedPrices[ intval( $priceId ) ] = $sanitizedPrice;
			}
		}

		if ( ! empty( $sanitizedPrices ) ) {
			update_post_meta( $productId, Product::VARIATION_PRICES_KEY, json_encode( $sanitizedPrices ) );
		} else {
			delete_post_meta( $productId, Product::VARIATION_PRICES_KEY );
		}
	}

	/**
	 * Sanitizes prices.
	 *
	 * @since 1.0
	 *
	 * @param array $prices
	 *
	 * @return array
	 * @throws \EDD_Exception
	 */
	private function sanitizePrices( array $prices ): array {
		$sanitizedPrices = [];

		try {
			if ( is_array( $prices ) ) {
				foreach ( $prices as $currency => $price ) {
					if ( eddMultiCurrency( CurrencyUtil::class )->isValidCurrency( $currency ) ) {
						$sanitizedPrice = ( '' === $price ) ? '' : edd_sanitize_amount( $price );

						$sanitizedPrices[ eddMultiCurrency( CurrencyUtil::class )::sanitizeCurrency( $currency ) ] = $sanitizedPrice;
					}
				}
			}
		} catch ( \Exception $e ) {
			return [];
		}

		return array_filter( $sanitizedPrices );
	}

}
