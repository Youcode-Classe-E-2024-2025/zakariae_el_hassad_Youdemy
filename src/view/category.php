<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../public/css/style-starter.css">
    <link href="//fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>

    <section class=" w3l-header-4">
        <header id="site-header">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-dark stroke">
                    <h1><a class="navbar-brand" href="index.html">
                        <span class="fa fa-book"></span> Tutee
                    </a></h1>
                    <button class="navbar-toggler  collapsed bg-gradient" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
                        <span class="navbar-toggler-icon fa icon-close fa-times"></span>
                        
                    </button>
          
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item @@about__active">
                                <a class="nav-link" href="home.html">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="about.html">category</a>
                            </li>
                            <li class="nav-item @@services__active">
                                <a class="nav-link" href="course.html">course</a>
                            </li>
                            <li class="nav-item @@about__active">
                                <a class="nav-link" href="ton_course.html">ton course</a>
                            </li>
                                <li class="nav-item mr-2">
                                    <a href="contact.html" class="btn btn-primary register d-lg-block btn-style">Contact</a>
                            </li>
                        </ul>
                    </div>
                            <!-- toggle switch for light and dark theme -->
                            <div class="mobile-position">
                                <label class="theme-selector">
                                  <input type="checkbox" id="themeToggle">
                                  <i class="gg-sun"></i>
                                  <i class="gg-moon"></i>
                                </label>
                              </div>
                              <!-- //toggle switch for light and dark theme -->
                </nav>
            </div>
          </header>
        <!--/header-->
    </section>

    <section class="w3l-specification-6">
        <div class="specification-layout editContent">
            <div class="container">
                <!-- Add Course Button -->
                <div class="d-flex justify-content-end mb-3">
                <button type="button" onclick="toggleModalCategory()" class="btn btn-primary">
    Add Course
  </button>
                </div>
    
                <!-- Grid Wrapper -->
                <div class="grid">
                    <figure class="effect-apollo ser-bg1">
                        <figcaption>
                            <h5><a href="course.html">Successfully Trained</a></h5>
                            <p class="para">Lorem ipsum dolor sit amet.Sit amet consect etur adipi sicing elit.</p>
                        </figcaption>
                        <div class="d-flex justify-content-between mt-4">
                            <!-- Edit Button -->
                            <a href="" 
                               class="btn btn-success btn-sm d-flex align-items-center gap-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        
                            <!-- Delete Button -->
                            <a href="" 
                               class="btn btn-danger btn-sm d-flex align-items-center gap-1">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </div>    
                    </figure>
                    <figure class="effect-apollo ser-bg2">
                        <figcaption>
                            <h5><a href="course.html">We Proudly Received</a></h5>
                            <p class="para">Lorem ipsum dolor sit amet.Sit amet consect etur adipi sicing elit.</p>
                        </figcaption>
                        <div class="d-flex justify-content-between mt-4">
                            <!-- Edit Button -->
                            <a href="" 
                               class="btn btn-success btn-sm d-flex align-items-center gap-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        
                            <!-- Delete Button -->
                            <a href="" 
                               class="btn btn-danger btn-sm d-flex align-items-center gap-1">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </div>    			
                    </figure>
                    <figure class="effect-apollo ser-bg3">
                        <figcaption>
                            <h5><a href="course.html">We Are Getting Featured On</a></h5>
                            <p class="para">Lorem ipsum dolor sit amet.Sit amet consect etur adipi sicing elit.</p>
                        </figcaption>
                        <div class="d-flex justify-content-between mt-4">
                            <!-- Edit Button -->
                            <a href="" 
                               class="btn btn-success btn-sm d-flex align-items-center gap-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        
                            <!-- Delete Button -->
                            <a href="" 
                               class="btn btn-danger btn-sm d-flex align-items-center gap-1">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </div>    			
                    </figure>
                    <figure class="effect-apollo ser-bg4">
                        <figcaption>
                            <h5><a href="#url">Firmly Established</a></h5>
                            <p class="para">Lorem ipsum dolor sit amet.Sit amet consect etur adipi sicing elit.</p>
                        </figcaption>
                        <div class="d-flex justify-content-between mt-4">
                            <!-- Edit Button -->
                            <a href="" 
                               class="btn btn-success btn-sm d-flex align-items-center gap-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        
                            <!-- Delete Button -->
                            <a href="" 
                               class="btn btn-danger btn-sm d-flex align-items-center gap-1">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </div>    			
                    </figure>
                </div>
            </div>
        </div>
    </section>


    <section id="addModalCategory" class="d-none position-fixed top-0 start-0 w-100 h-100 d-flex align-items-start justify-content-center bg-dark bg-opacity-50">
  <div class="bg-white rounded shadow p-4 w-50 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="h4 fw-bold text-secondary">Add Category</h2>
      <button type="button" onclick="returnPage1()" class="btn btn-primary">Close</button>
    </div>
    <form action="?action=save_category" method="POST">
      <div class="mb-3">
        <label for="categoryName" class="form-label text-secondary">Name</label>
        <input 
          type="text" 
          name="name" 
          id="categoryName" 
          class="form-control" 
          placeholder="Jane Doe">
      </div>
      <div class="mb-3">
        <label for="categoryDescription" class="form-label text-secondary">Description</label>
        <textarea 
          name="description" 
          id="categoryDescription" 
          class="form-control" 
          rows="3" 
          placeholder="Enter some long form content."></textarea>
      </div>
      <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary">ADD</button>
      </div>
    </form>
  </div>
</section>

    
    <script>
       const ModalCategory = document.getElementById("addModalCategory");

function toggleModalCategory() {
  console.log("toggleModalCategory called");
  ModalCategory.classList.remove("d-none");
  ModalCategory.classList.remove("position-fixed");
  ModalCategory.classList.add("d-flex");
}


function returnPage1() {
  ModalCategory.classList.add("d-none");
  ModalCategory.classList.add("position-fixed");
  ModalCategory.classList.remove("d-flex");
} 

    </script>
    
</body>
</html>