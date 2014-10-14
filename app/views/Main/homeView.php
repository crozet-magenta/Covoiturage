<p>this is the home controller :)</p>
<div>
<a href="<?php echo Url::route('TestController@hello') ?>" title="hello">go to hello world</a><br>
<a href="<?php echo Url::route('TestController@hello', ['name' => 'world']) ?>" title="hello">go to hello name</a><br>
</div>
<div>
    <?php foreach ($data as $text): ?>
        <p><?php echo $text['z'] ?></p>
    <?php endforeach ?>
</div>