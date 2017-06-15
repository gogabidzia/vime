<div id="search">
	<form action="/search" method="get">
		<div class="form-group">
			<div class="input-group">
			  <input type="text" name="keyword" class="form-control" placeholder="ძებნა"> 
			  <span class="input-group-addon">
			  	<i class="fa fa-search"></i>
			  </span>
			</div>			
		</div>
		<div class="form-group">
			<div class="input-group">
			  <select class="form-control" name="type">
			  	<option value="vacancy">ვაკანსიები</option>
			  	<option value="facecontrol">ივენთები</option>
			  </select>
			  <span class="input-group-addon">
			  	<i class="fa fa-th-large"></i>
			  </span>
			</div>			
		</div>
		<div class="form-group fcFormGroup">
			<div class="input-group">
				<select name="location" class="form-control">
	            	<option value="" disabled selected>ლოკაცია</option>
                    <option value="თბილისი">თბილისი</option>
                    <option value="აფხაზეთის ა/რ">აფხაზეთის ა/რ</option>
                    <option value="აჭარის ა/რ">აჭარის ა/რ</option>
                    <option value="გურია">გურია</option>
                    <option value="იმერეთი">იმერეთი</option>
                    <option value="კახეთი">კახეთი</option>
                    <option value="მცხეთა-მთიანეთი">მცხეთა-მთიანეთი</option>
                    <option value="რაჭა-ლეჩხუმი, ქვ. სვანეთი">რაჭა-ლეჩხუმი, ქვ. სვანეთი</option>
                    <option value="სამეგრელო-ზემო სვანეთი">სამეგრელო-ზემო სვანეთი</option>
                    <option value="სამცხე-ჯავახეთი">სამცხე-ჯავახეთი</option>
                    <option value="ქვემო ქართლი">ქვემო ქართლი</option>
                    <option value="შიდა ქართლი">შიდა ქართლი</option>
                    <option value="უცხოეთი">უცხოეთი</option>
				</select>
			  <span class="input-group-addon">
			  	<i class="fa fa-globe"></i>
			  </span>
			</div>			
		</div>
		<div class="form-group fcFormGroup">
			<div class="input-group">
				<select name="category" class="form-control">
	            	<option value="" disabled selected>განცხადების ტიპი</option>
                    <option value="0">ვაკანსიები</option>
                    <option value="1">სტიპენდიები</option>
                    <option value="2">ტრენინგები</option>
                    <option value="3">ტენდერები</option>
                    <option value="4">სხვა</option>
				</select>
			  <span class="input-group-addon">
			  	<i class="fa fa-list"></i>
			  </span>
			</div>	
		</div>
		<div class="form-group">
			<button type="submit" class="btn greenBtn pull-right">
				ძებნა
			</button>
			<div class="clearfix"></div>
		</div>
	</form>
</div>
<script type="text/javascript">
	
</script>