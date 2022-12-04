<?php
    session_start();
    include('../config/ketnoi.php');

    if (true) {
    }
    else {
        header('Location:../login.php');
    }
    /*
      MỤC ĐÍCH PAGE NÀY
      SHOW TẤT CẢ CÁC HỌC VIÊN
    */
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Học Viên</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/allcss.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="./css/mycourse.css">
    <!-- Icon CDN -->
    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Text -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php require "./partial/header-logined.php"?>
    <div class="content container-fluid !direction !spacing">
      <div class="row">
        <div class="col-3 navigation-bar">
          <?php require "./partial/nav-bar.php"?>
        </div>
        <div class="col-9">
          <div class="link row">
              <div class="text">Quản Lý Học Viên</div>  
          </div>
          <div class="wrapper-content row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Thông Tin Học Viên</h3>
                            <div class="table-responsive contain-admin__table" >
                                <table class="table text-nowrap"  id="editable_table" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Họ và Tên</th>
                                            <th>Địa Chỉ</th>
                                            <th>Ngày Sinh</th>
                                            <th>Tuổi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        $sqlstudent =  $con->query("SELECT * FROM student ");
                                        if($sqlstudent->num_rows > 0) {
                                          $output = '';
                                          $i = 0;
                                          while($rowstudent = $sqlstudent->fetch_assoc()) {
                                            $i++;
                                            $output .= '<tr> 
                                              <td>'.$i.'</td>
                                              <td>'.$rowstudent['student_id'].'</td>
                                              <td>'.$rowstudent['name'].'</td> 
                                              <td>'.$rowstudent['address'].'</td>
                                              <td>'.$rowstudent['dob'].'</td>
                                              <td style = "font-size: 18px">
                                                <button type="button" data-toggle="modal" data-target="#editModal" class="btn btn-success"><iconify-icon icon="material-symbols:edit"></iconify-icon></button>
                                                <button type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger deletecourse" style="color: #fff"><iconify-icon icon="mdi:trash"></iconify-icon></button>
                                              </td>
                                              </tr>
                                              ';
                                          }
                                        }
                                        echo $output;
                                      ?> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
          </div>
        </div>
      </div>
      <!-- Delete Request Modal -->
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Xoá Yêu Cầu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Bạn có chắc sẽ xoá sinh viên này chứ ?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger">Yes</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Edit Request Modal -->
      <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createRequestModalTitle">Chỉnh sửa thông tin sinh viên</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <div class="form-group">
                  <label for="inputName">Họ và Tên</label>
                  <input type="text" class="form-control" id="inputName" placeholder="Hồ Hoàng Huy">
                </div>
                <div class="form-group">
                  <label for="inputName">Địa chỉ</label>
                  <input type="text" class="form-control" id="inputName" placeholder="Hồ Hoàng Huy">
                </div>
                <div class="form-group">
                  <label for="inputName">Số điện thoại</label>
                  <input type="number" class="form-control" id="inputName" placeholder="Hồ Hoàng Huy">
                </div>
                <div class="form-group">
                  <label for="inputName">Giới tính</label>
                  <input type="text" class="form-control" id="inputName" placeholder="Hồ Hoàng Huy">
                </div>
                <div class="form-group">
                  <label for="inputName">Ngày sinh</label>
                  <input type="date" class="form-control" id="inputName" placeholder="Hồ Hoàng Huy">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require "../partial/footer.php"?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>  
      $(document).ready(function(){
          $('.input-sm').keyup(function(){
              var text = $('.input-sm').val();
              $.post('searchstudent.php', {data : text}, function(data){
                  $('.contain-admin__table').html(data);
              })
          });
            
          $('#editable_table').Tabledit({
              url:'action.php',
              columns:{
              identifier:[0, "id"],
              editable:[[1, 'name'], [2, 'address'], [3, 'sex'], [4, 'dob']]
          },
          restoreButton:false,
          onSuccess:function(data, textStatus, jqXHR)
          {
              if(data.action == 'delete')
              {
                  console.log(1);
                  $('#'+data.id).remove();
              }
          }
          });
          
          $('#add').click(function(){
              var html = '<tr>';
              html += '<td contenteditable id="data1"></td>';
              html += '<td contenteditable id="data2"></td>';
              html += '<td contenteditable id="data3"></td>';
              html += '<td contenteditable id="data4"></td>';
              html += '<td contenteditable id="data5"></td>';
              html += '<td contenteditable id="data6"></td>';
              html += '<td contenteditable id="data7"></td>';
              html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
              html += '</tr>';
              $('#editable_table tbody').prepend(html);
          });

          $(document).on('click', '#insert', function(){
              var cid = $('#data1').text();
              var sid = $('#data2').text();
              var sname = $('#data3').text();

              var time = $('#data4').text();
              var content = $('#data5').text();
              var eid = $('#data6').text();
              var ename = $('#data6').text();
              if(cid != '' && sid != '' && sname != '' && time != '' && content != '' && eid != '' && ename != '')
              {

                  if (cid.length != 15  || sid.length != 7) {

                      alert("Check your enterd details..")
                  } 
                  else {
                  $.ajax({
                          url:"insertrequest.php",
                          method:"POST",
                          data:{cid:cid, sid:sid, sname:sname, time:time, content:content, eid:eid, ename:ename},
                          success:function(data)
                          {
                          $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                          $('#user_data').DataTable().destroy();
                          fetch_data();
                          }
                      });
                      setInterval(function(){
                          $('#editable_table').html('');
                      }, 5000);
                  }
              }
              else
              {
                  alert("All Fields required");
              }
          });
          
          const toggle = document.querySelector('.navbar-toggler-icon');
          const info = document.querySelector('.collapse');
          toggle.addEventListener('click',function(e){
              if(info.style.display == "none"){
                  info.style.display = "block";
              }
              else{
                  info.style.display = "none";
              }
          });
      });
    </script>
  </body>
</html>