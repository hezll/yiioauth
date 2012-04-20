<?php foreach($this->getAskTypeList() as $asktype): ?>
<option value="<?php echo $asktype->id; ?>"><?php echo $asktype->typename; ?></option>
<?php endforeach; ?>
