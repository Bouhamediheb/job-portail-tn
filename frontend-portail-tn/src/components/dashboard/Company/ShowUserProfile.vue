<template>

<section class="section-box-2">
            <div class="container">
                <div class="banner-hero banner-image-single"><img src="/assets/home/imgs/page/candidates/img.png" alt="jobbox"></div>
                <div class="box-company-profile">
                    <div class="image-compay"><img src="/assets/home/imgs/page/candidates/candidate-profile.png" alt="jobbox"></div>
                    <div class="col mt-10">
                        <div class="col-lg-8 col-md-12">
                            <h5 class="f-18">Steven Jobs</h5>
                           </div>
                    </div>
                </div>


             


                <div class="border-bottom pt-10 pb-10"></div>
            </div>
        </section>
        <section class="section-box mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="content-single">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-short-bio" role="tabpanel" aria-labelledby="tab-short-bio">
                                    <h4>A propos du profil :</h4>
                                    <p>{{  }}</p>
                                 
                                    <h4>Les compétences :</h4>
                                    <div class="row ">
                                        
                                    </div>
                                    <h4>Parcours Professionel</h4>
                                    <ul>
                                        
                                    </ul>
                                    <h4>Parcours Académique</h4>
                                    <ul>
                                        
                                    </ul>
                                </div>
                                <div class="tab-pane " >
                                    <h4>Skills</h4>
                                    <p></p>Hello there! My name is Alan Walker. I am a graphic designer, and I&rsquo;m very passionate and dedicated to my work. With 20 years experience as a professional a graphic designer, I have acquired the skills and
                                    knowledge necessary to make your project a success.
                                    <p></p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis illum fuga eveniet. Deleniti asperiores, commodi quae ipsum quas est itaque, ipsa, dolore beatae voluptates nemo blanditiis iste eius officia minus.
                                    Id nisi, consequuntur sunt impedit quidem, vitae mollitia!
                                </div>
                                <div class="tab-pane fade" >
                                    <h4>Work Experiences</h4>
                                    <p></p>Hello there! My name is Alan Walker. I am a graphic designer, and I&rsquo;m very passionate and dedicated to my work. With 20 years experience as a professional a graphic designer, I have acquired the skills and
                                    knowledge necessary to make your project a success.
                                    <p></p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis illum fuga eveniet. Deleniti asperiores, commodi quae ipsum quas est itaque, ipsa, dolore beatae voluptates nemo blanditiis iste eius officia minus.
                                    Id nisi, consequuntur sunt impedit quidem, vitae mollitia!
                                </div>
                            </div>
                        </div>
                     
                    </div>
                    
                </div>
            </div>
        </section>
      
    
</template>

<script setup>

</script>

<style scoped>



/* Container Styles */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

/* Banner Hero */
.banner-hero {
    margin-bottom: 20px;
}

.banner-hero img {
    width: 100%;
    height: auto;
}

/* Company Profile Box */
.box-company-profile {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.image-compay img {
    border-radius: 50%;
    width: 100px;
    height: 100px;
}

.box-company-profile h5 {
    font-size: 18px;
    margin-bottom: 5px;
}

.box-company-profile .card-location {
    font-size: 14px;
    color: #777;
}

.box-company-profile p {
    font-size: 14px;
    color: #555;
}

.box-company-profile .progress {
    background-color: #e9ecef;
    height: 6px;
}

.box-company-profile .progress-bar {
    height: 6px;
    line-height: 6px;
}





/* Content Single */
.content-single {
    margin-bottom: 30px;
}

.content-single h4 {
    font-size: 20px;
    margin-bottom: 10px;
}

.content-single ul {
    list-style-type: disc;
    padding-left: 20px;
}

.content-single ul li {
    margin-bottom: 10px;
}

/* Related Jobs */
.box-related-job {
    margin-bottom: 30px;
}

.box-list-jobs {
    display: flex;
    flex-direction: column;
}

.card-grid-2 {
    display: flex;
    margin-bottom: 20px;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #fff;
}

.card-grid-2 img {
    max-width: 100%;
    height: auto;
}

.card-grid-2 .card-block-info h4 {
    font-size: 16px;
    margin-bottom: 10px;
}

.card-2-bottom {
    margin-top: 20px;
}

.sidebar-border {
    padding: 15px;
    margin-bottom: 20px;
}

.sidebar-border-bg {
    background-color: #f5f5f5;
    padding: 20px;
    text-align: center;
}

.sidebar-list-job ul {
    list-style: none;
    padding: 0;
}

.sidebar-list-job ul li {
    margin-bottom: 10px;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    font-size: 14px;
    border: none;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
}

.btn-download-icon {
    background-color: #007bff;
    color: #fff;
}

.btn-download-icon:hover {
    background-color: #0056b3;
}

.btn-apply-now {
    background-color: #28a745;
    color: #fff;
}

.btn-apply-now:hover {
    background-color: #218838;
}

.btn-grey-small {
    background-color: #6c757d;
    color: #fff;
    margin-right: 5px;
}

.btn-grey-small:hover {
    background-color: #5a6268;
}

.btn-send-message, .btn-paragraph-2 {
    background-color: #007bff;
    color: #fff;
}

.btn-send-message:hover, .btn-paragraph-2:hover {
    background-color: #0056b3;
}

.paginations {
    text-align: center;
}

.pager {
    list-style: none;
    padding: 0;
    margin: 0;
}

.pager a {
    display: inline-block;
    padding: 10px;
    border: 1px solid #ddd;
    margin: 0 5px;
    text-decoration: none;
    color: #007bff;
}

.pager a.active {
    background-color: #007bff;
    color: #fff;
}

.pager a:hover {
    background-color: #0056b3;
    color: #fff;
}

.flex-row {
    display: flex !important;
    flex-direction: row !important;
    gap: 15px !important; /* Adjust the gap between items as needed */
}

.flex-row li {
    list-style: none;
}

</style>

