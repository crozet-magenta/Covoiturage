<p>this is the home controller :)</p>
<div>
<a href="<?php echo Url::route('Test@hello') ?>" title="hello">go to hello world</a><br>
<a href="<?php echo Url::route('Test@hello', ['name' => 'world']) ?>" title="hello">go to hello name</a><br>
</div>