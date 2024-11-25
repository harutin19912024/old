<?php

/* @var $this yii\web\View */


$this->title = 'Home Page';
//echo "<pre>"; print_r($lastAddedProducts);die;
?>

<!-- Latest Product Begin -->
<section class="latest-products spad">
    <div class="container">
	<?php if($lastAddedProducts->count()):?>
        <div class="product-filter">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-title">
                        <h2>Latest Products</h2>
                    </div>
                    <ul class="product-controls">
                        <li data-filter="*">All</li>
                        <?php foreach ($types as $type):?>
                        <li data-filter=".<?=$type->name?>"><?=$type->name?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row" id="product-list">
            <?php foreach ($lastAddedProducts as $product):?>
                <div class="col-lg-3 col-sm-6 mix all <?=$product->type->name?>">
                    <div class="single-product-item">
                        <figure>
                            <a href="#"><img src="<?=$product->getImage()?>" alt=""></a>
                        </figure>
                        <div class="product-text">
                            <h6><?=$product->name?></h6>
                            <p>$<?=$product->price?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
		<?php endif;?>
    </div>
</section>
<!-- Latest Product End -->