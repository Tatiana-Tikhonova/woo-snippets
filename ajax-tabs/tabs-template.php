<!-- вставить в нужное место в шаблоне страницы -->
<div class="home-tabs">
    <nav class="home-tabs__buttons buttons">
        <button type="submit" class="home-tabs-buttons__btn active" data-tabs="hits">Хиты продаж</button>
        <button type="submit" class="home-tabs-buttons__btn" data-tabs="news">Новинки</button>
        <button type="submit" class="home-tabs-buttons__btn" data-tabs="recommend">Рекомендуемые</button>
        <button type="submit" class="home-tabs-buttons__btn" data-tabs="sale">Распродажа</button>
    </nav>
    <div class="home-tabs__panel">
        <div class="products">
            <?php
            get_template_part('template-parts/home-tabs/hits');
            ?>
        </div>
        <div class="home-tabs__overlay"></div>
    </div>
</div>