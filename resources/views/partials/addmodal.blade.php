<div id="addModal" class="modal fade loginModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title text-center">
        	დამატება
        </h3>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger errors" style="display: none;">
        </div>
        <div class="switcher tableCentered" style="margin-bottom: 20px;">
          <button class="btn greenBtn vacancy active" style="margin-right: 20px;">ვაკანსია</button>
          <button class="btn greenBtn event">ივენთი</button>
        </div>
        <div class="vacancyform">
          <form id="addVacancy" action="/vacancies/add" method="post" class="myFormControl">
              <input type="hidden" name="type" value="vacancy">
    	        <div class="form-group">
    	            <input class="form-control" name="position" placeholder="თანამდებობა"></input>
    	        </div>
    	        <div class="form-group">
    	            <textarea type="text" class="form-control" name="description" placeholder="აღწერა"></textarea>
    	        </div>
    	        <div class="row">
    	        	<div class="form-group col-sm-6">
    	        		<input name="date_from" class="form-control" placeholder="თარიღი(დან)"></input>
    	        	</div>
    	        	<div class="form-group col-sm-6">
    	        		<input name="date_to" class="form-control" placeholder="თარიღი(მდე)"></input>
    	        	</div>
    	        	<div class="clearfix"></div>
    	        </div>
    	        <div class="form-group">
    	            <select name="location" class="form-control">
    	            	<option value="" disabled selected>ლოკაცია</option>
                        <option value="0">თბილისი</option>
                        <option value="1">აფხაზეთის ა/რ</option>
                        <option value="2">აჭარის ა/რ</option>
                        <option value="3">გურია</option>
                        <option value="4">იმერეთი</option>
                        <option value="5">კახეთი</option>
                        <option value="6">მცხეთა-მთიანეთი</option>
                        <option value="7">რაჭა-ლეჩხუმი, ქვ. სვანეთი</option>
                        <option value="8">სამეგრელო-ზემო სვანეთი</option>
                        <option value="9">სამცხე-ჯავახეთი</option>
                        <option value="10">ქვემო ქართლი</option>
                        <option value="11">შიდა ქართლი</option>
                        <option value="12">უცხოეთი</option>
    				</select>
    	        </div>
    	        <div class="form-group">
    	            <select name="category" class="form-control">
    	            	<option value="" disabled selected>განცხადების ტიპი</option>
                        <option value="0">ვაკანსიები</option>
                        <option value="1">სტიპენდიები</option>
                        <option value="2">ტრენინგები</option>
                        <option value="3">ტენდერები</option>
                        <option value="4">სხვა</option>
    				      </select>
    	        </div>
    	        {{csrf_field()}}
    	        
    	        <div class="pull-right">
    	            <button class="btn authBtn" type="submit" name="">დამატება</button> 
    	        </div>
    	        <div class="clearfix"></div>
            </form>
        </div>
        <div class="eventform" style="display: none;">
              <form id="addEvent" action="/vacancies/add" method="post" class="myFormControl">
              <input type="hidden" name="type" value="event">
              <div class="form-group">
                  <input class="form-control" name="position" placeholder="სათაური"></input>
              </div>
              <div class="form-group">
                  <textarea type="text" class="form-control" name="description" placeholder="აღწერა"></textarea>
              </div>
              <div class="form-group">
                <input class="form-control" type="text" name="location" placeholder="ლოკაცია">
              </div>
              {{csrf_field()}}
              
              <div class="pull-right">
                  <button class="btn authBtn" type="submit" name="">დამატება</button> 
              </div>
              <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>