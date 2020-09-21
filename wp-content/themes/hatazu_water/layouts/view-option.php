<div class="products-view__options">
    <div class="view-options view-options--offcanvas--mobile">
        <div class="view-options__filters-button">
            <button type="button" class="filters-button">
                <svg class="filters-button__icon" width="16px" height="16px">
                    <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#filters-16"></use>
                </svg>
                <span class="filters-button__title">Filters</span>
                <span class="filters-button__counter">3</span>
            </button>
        </div>
        <div class="view-options__layout">
            <div class="layout-switcher">
                <div class="layout-switcher__list">
                    <button data-layout="grid-3-sidebar" data-with-features="false" title="Grid" type="button" class="layout-switcher__button  layout-switcher__button--active ">
                        <svg width="16px" height="16px">
                            <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#layout-grid-16x16"></use>
                        </svg>
                    </button>
                    <button data-layout="grid-3-sidebar" data-with-features="true" title="Grid With Features" type="button" class="layout-switcher__button ">
                        <svg width="16px" height="16px">
                            <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#layout-grid-with-details-16x16"></use>
                        </svg>
                    </button>
                    <button data-layout="list" data-with-features="false" title="List" type="button" class="layout-switcher__button ">
                        <svg width="16px" height="16px">
                            <use xlink:href="<?php echo get_template_directory_uri()  . '/images/sprite.svg'; ?>#layout-list-16x16"></use>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="view-options__legend">Showing 6 of 98 products</div>
        <div class="view-options__divider"></div>
        <div class="view-options__control">
            <label for="">Sort By</label>
            <div>
                <select class="form-control form-control-sm" name="" id="">
                    <option value="">Default</option>
                    <option value="">Name (A-Z)</option>
                </select>
            </div>
        </div>
        <div class="view-options__control">
            <label for="">Show</label>
            <div>
                <select class="form-control form-control-sm" name="" id="">
                    <option value="">12</option>
                    <option value="">24</option>
                </select>
            </div>
        </div>
    </div>
</div>