<section @style(['padding-left: 10px', 'padding-right: 10px' , 'display: none'=> !$display])>
    <div class="box box-solid">
        <?php $c = true ?>
        <div @class(['box-body', "bg-green"=> $color, 'bg-red' => !$color ])>
            <p> {{$message}} </p>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</section>