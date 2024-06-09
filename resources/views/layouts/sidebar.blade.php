    <!-- SIDE BAR -->
    <div class="offcanvas offcanvas-start show sidebarMenu w-auto" data-bs-scroll="true" data-bs-backdrop="false">
        <div class="offcanvas-body">
          <div class="logo d-flex py-2 px-0 align-items-center">
            <img src="img/logo705.png" alt="logo" width="55" height="40">
            <p class="text-white fs-3 ps-2 mb-0">705 <span class="fs-5">Storage</span></p>
          </div>0
          <div class="firstMenus d-flex flex-column list-group mt-2 justify-content-between">
            <div class="firstMenusTop">
              <a href="/" class="list-group-item list-group-item-action list-group-item-light border-0 rounded-2 text-white" onclick="selectButton(this)"><i class="bi bi-house-door-fill pe-3"></i>Home</a>
              <a href="/history" class="list-group-item list-group-item-action list-group-item-light border-0 rounded-2 text-white" onclick="selectButton(this)"><i class="bi bi-clock-history pe-3"></i>History</a>
  
              {{-- <a href="#" class="list-group-item list-group-item-action list-group-item-light border-0 rounded-2 text-white" onclick="selectButton(this)"><i class="bi bi-tags-fill pe-3"></i>Category</a> --}}
              <button type="button" class=" border-0 text-white list-group-item list-group-item-action btn btn-danger categorybtn bg-transparent" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-tags-fill pe-3"></i>Category <i class="bi bi-caret-down-fill ps-2"></i></button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                <li><a class="dropdown-item" href="#">Action</a></li>
              </ul>



              <div class="garis my-4"></div>
              <a href="/setting" class="list-group-item list-group-item-action list-group-item-light border-0 rounded-2 text-white" onclick="selectButton(this)"><i class="bi bi-gear-fill pe-3"></i>Setting</a>
              <a href="#" class="list-group-item list-group-item-action list-group-item-light border-0 rounded-2 text-white" onclick="selectButton(this)"><i class="bi bi-box-arrow-right pe-3"></i>Logout</a>
            </div>
          </div>
        </div>
      </div>