<div class="">

    <!-- Show Banners in circle -->
    <div class="mainFrameBaner">
        <section class="container">
            {$banners = ShopCore::app()->SBannerHelper->getBanners()}
            {if count($banners)}
                    <div class="frame_baner">
                        <ul class="cycle">
                            {foreach $banners as $banner}
                                <li>
                                    <a href="{echo $banner['url']}">
                                        <img src="/uploads/shop/banners/{echo $banner['image']}" />
                                    </a>
                                </li>
                            {/foreach}
                        </ul>
                        <div class="pager"></div>
                        <button class="next" type="button"></button>
                        <button class="prev" type="button"></button>
                    </div>
            {/if}
        </section>
    </div>
    <!-- Show banners in circle -->


    <!--                ТЕСТ ФЕНСІ-->
    <!--    <a href="{$SHOP_THEME}/images/temp/cycle_1.jpg" class="img" rel="group"><img src="{$SHOP_THEME}/images/temp/item_1.jpg" alt="Apple MacBook Pro A1286" /></a>-->
    <!--    <a href="{$SHOP_THEME}/images/temp/cycle_2.jpg" class="img" rel="group"><img src="{$SHOP_THEME}/images/temp/item_2.jpg" alt="Apple MacBook Pro A1286" /></a>-->
    <!--                ЕНД-->
    {widget('popular_products')}
    {widget('new_products')}
    {widget('action_products')}
    
</div>