@if( count($data ))
    <div class="page_bottom center">
        <?php echo $data->render(); ?>
    </div>
@else
    <h3 class="center">{{ isset($text) ? $text : "无内容"}}</h3>
@endif