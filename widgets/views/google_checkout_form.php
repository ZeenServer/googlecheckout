<form action="<?php echo $action; ?>" method="post">
    <input type="hidden" name="cart" value="<?php echo $cart; ?>">
    <input type="hidden" name="signature" value="<?php echo $signature; ?>">
    <div class="buttons">
        <div class="right">
          <input type="submit" value="submit" class="button" />
        </div>
    </div>
</form>