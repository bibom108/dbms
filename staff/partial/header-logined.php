<div class="header">
  <div class="container-fluid !direction !spacing">
      <div class="row">
          <div class="col-2 logo"  onclick="window.location.assign('./home.php');">
              <div class="text">VASCO</div>
          </div>
          <div class="col-7 search-bar">
              <nav class="navbar" style="width: 100%">
                  <form class="form-inline search-wrapper">
                    <input class="form-control" type="search" placeholder="Tìm kiếm khoá học tại đây..." aria-label="Search">
                    <iconify-icon icon="material-symbols:search-rounded"></iconify-icon>
                  </form>
                </nav>
          </div>
          <div class="col-3 row button-bar">
              <div class="notice"><i class="fa fa-bell" aria-hidden="true"></i></div>
              <div class="user">
                    <ul>
                        <li onclick="window.location.assign('./student/profile.php');">Trang cá nhân</li>
                        <li >Đăng xuất</li>
                    </ul>
              </div>   
          </div>
      </div>
  </div>
</div>
<script>
  const user = document.querySelector('.button-bar .user');
  user.addEventListener('click', function () {
      const list = document.querySelector('.button-bar .user ul');
      list.classList.toggle("appear") 
  });
</script>