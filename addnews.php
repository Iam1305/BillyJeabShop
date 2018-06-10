<form action="add_articles2.php" method="POST" enctype="multipart/form-data"  name="addform" class="form-horizontal" id="addform">
    	<div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
       <b> เพิ่มข่าว : devbanban.com</b>
      &nbsp;ยินดีต้อนรับ <?php echo $row_member['m_name']; ?></div>
       </div>
       <div class="form-group">
       	<div class="col-sm-2" align="right"> ประเภทข่าว : </div>
          <div class="col-sm-5" align="left">
            <label>
              <select name="a_type_id" id="a_type_id">
                <option>-เลือกประเภทข่าว-</option>
              </select>
            </label>
          </div>
      </div>
       <div class="form-group">
       	<div class="col-sm-2" align="right"> หัวข้อข่าว : </div>
          <div class="col-sm-8" align="left">
            <input  name="title" id="title" type="text" required class="form-control"  placeholder="หัวข้อข่าว"/>
          </div>
      </div>
        
        <div class="form-group">
        <div class="col-sm-2" align="right">รายละเอียด</div>
          <div class="col-sm-8" align="left">
           <textarea name="txtMessage" id="txtMessage" class="ckeditor" cols="69" rows="5"></textarea>
          </div>
        </div>
        
        
        <div class="form-group">
        <div class="col-sm-2" align="right">ไฟล์ประกอบ</div>
          <div class="col-sm-7" align="left">
            <input type="file" name="img" id="img" required accept="image/jpeg">
          </div>
        </div>
        
      <div class="form-group">
      <div class="col-sm-2"> </div>
          <div class="col-sm-6">
          <button type="submit" class="btn btn-primary" id="btn"> บันทึก
           </button>
          <input name="m_username" type="hidden" id="m_username" value="<?php echo $row_member['m_username']; ?>">
          </div>
           
      </div>
      </form>