<?php foreach ($filterlists as $filterlist) : ?>
  <div class="ajax-posts__filterlist">
  
    <ul class="ajax-post__filter-category <?php echo esc_html( $filterlist['id'] ); ?>">
          <li class="is-active-m is_active_reset">
          <a href="#" class="ajax-posts__filter js-reset-filters">
              All
          </a>
        </li>
      <?php foreach ($filterlist['filters'] as $filter) : ?>
        <li>
          <a href="<?= get_term_link( $filter, $filter->taxonomy ); ?>" class="ajax-posts__filter" data-filter="<?= $filter->taxonomy; ?>" data-term="<?= $filter->slug; ?>">
              <?= $filter->name; ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
    
  </div>
<?php endforeach; ?>