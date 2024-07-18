<template>
  <div v-if="job">
    <section class="section-box-2">
      <div class="container">
        <div class="banner-hero banner-image-single"><img :src="job.thumbnail" alt="jobBox"></div>
        <div class="row mt-10">
          <div class="col-lg-8 col-md-12">
            <h3>{{ job.title }}</h3>
            <div class="mt-0 mb-15">
              <span class="card-briefcase">{{ job.employmentType === 1 ? 'Fulltime' : 'Parttime' }}</span>
              <span class="card-time">Posted {{ timeAgo(job.postedDate) }}</span>
            </div>
          </div>
          <div class="col-lg-4 col-md-12 text-lg-end">
            <div class="btn btn-apply-icon btn-apply btn-apply-big hover-up" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">Apply now</div>
          </div>
        </div>
        <div class="border-bottom pt-10 pb-10"></div>
      </div>
    </section>

    <section class="section-box mt-50">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="job-overview">
              <h5 class="border-bottom pb-15 mb-30">Employment Information</h5>
              <div class="row">
                <div class="col-md-6 d-flex">
                  <div class="sidebar-icon-item"><img src="assets/home/imgs/page/job-single/industry.svg" alt="jobBox"></div>
                  <div class="sidebar-text-info ml-10">
                    <span class="text-description industry-icon mb-10">Industry</span>
                    <strong class="small-heading">{{ job.industry }}</strong>
                  </div>
                </div>
                <div class="col-md-6 d-flex mt-sm-15">
                  <div class="sidebar-icon-item"><img src="assets/home/imgs/page/job-single/job-level.svg" alt="jobBox"></div>
                  <div class="sidebar-text-info ml-10">
                    <span class="text-description joblevel-icon mb-10">Job level</span>
                    <strong class="small-heading">{{ job.jobLevel }}</strong>
                  </div>
                </div>
              </div>
              <div class="row mt-25">
                <div class="col-md-6 d-flex mt-sm-15">
                  <div class="sidebar-icon-item"><img src="assets/home/imgs/page/job-single/salary.svg" alt="jobBox"></div>
                  <div class="sidebar-text-info ml-10">
                    <span class="text-description salary-icon mb-10">Salary</span>
                    <strong class="small-heading">${{ job.salary.min }} - ${{ job.salary.max }}</strong>
                  </div>
                </div>
                <div class="col-md-6 d-flex">
                  <div class="sidebar-icon-item"><img src="assets/home/imgs/page/job-single/experience.svg" alt="jobBox"></div>
                  <div class="sidebar-text-info ml-10">
                    <span class="text-description experience-icon mb-10">Experience</span>
                    <strong class="small-heading">{{ job.experience.min }} - {{ job.experience.max }} years</strong>
                  </div>
                </div>
              </div>
              <div class="row mt-25">
                <div class="col-md-6 d-flex mt-sm-15">
                  <div class="sidebar-icon-item"><img src="assets/home/imgs/page/job-single/job-type.svg" alt="jobBox"></div>
                  <div class="sidebar-text-info ml-10">
                    <span class="text-description jobtype-icon mb-10">Job type</span>
                    <strong class="small-heading">{{ job.jobType }}</strong>
                  </div>
                </div>
                <div class="col-md-6 d-flex mt-sm-15">
                  <div class="sidebar-icon-item"><img src="assets/home/imgs/page/job-single/deadline.svg" alt="jobBox"></div>
                  <div class="sidebar-text-info ml-10">
                    <span class="text-description mb-10">Deadline</span>
                    <strong class="small-heading">{{ job.deadline }}</strong>
                  </div>
                </div>
              </div>
              <div class="row mt-25">
                <div class="col-md-6 d-flex mt-sm-15">
                  <div class="sidebar-icon-item"><img src="assets/home/imgs/page/job-single/updated.svg" alt="jobBox"></div>
                  <div class="sidebar-text-info ml-10">
                    <span class="text-description jobtype-icon mb-10">Updated</span>
                    <strong class="small-heading">{{ job.updated }}</strong>
                  </div>
                </div>
                <div class="col-md-6 d-flex mt-sm-15">
                  <div class="sidebar-icon-item"><img src="assets/home/imgs/page/job-single/location.svg" alt="jobBox"></div>
                  <div class="sidebar-text-info ml-10">
                    <span class="text-description mb-10">Location</span>
                    <strong class="small-heading">{{ job.location }}</strong>
                  </div>
                </div>
              </div>
            </div>
            <div class="content-single">
              <h4>{{ job.company }} Team</h4>
              <p>{{ job.companyDescription }}</p>
              <h4>Essential Knowledge, Skills, and Experience</h4>
              <ul>
                <li v-for="skill in job.skills">{{ skill }}</li>
              </ul>
              <h4>Preferred Experience</h4>
              <ul>
                <li v-for="experience in job.preferredExperience">{{ experience }}</li>
              </ul>
              <h4>{{ job.position }}</h4>
              <p><strong>Product knowledge:</strong> {{ job.productKnowledge }}</p>
              <p><strong>Research:</strong> {{ job.research }}</p>
              <p><strong>Deliverables:</strong> {{ job.deliverables }}</p>
              <p><strong>Communication:</strong> {{ job.communication }}</p>
            </div>
            <div class="author-single"><span>{{ job.author }}</span></div>
            <div class="single-apply-jobs">
              <div class="row align-items-center">
                <div class="col-md-5">
                  <a class="btn btn-default mr-15" href="#">Apply now</a>
                  <a class="btn btn-border" href="#">Save job</a>
                </div>
                <div class="col-md-7 text-lg-end social-share">
                  <h6 class="color-text-paragraph-2 d-inline-block d-baseline mr-10">Share this</h6>
                  <a class="mr-5 d-inline-block d-middle" href="#"><img alt="jobBox" src="assets/home/imgs/template/icons/share-fb.svg"></a>
                  <a class="mr-5 d-inline-block d-middle" href="#"><img alt="jobBox" src="assets/home/imgs/template/icons/share-tw.svg"></a>
                  <a class="mr-5 d-inline-block d-middle" href="#"><img alt="jobBox" src="assets/home/imgs/template/icons/share-red.svg"></a>
                  <a class="d-inline-block d-middle" href="#"><img alt="jobBox" src="assets/home/imgs/template/icons/share-whatsapp.svg"></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
            <div class="sidebar-border">
              <div class="sidebar-heading">
                <div class="avatar-sidebar">
                  <figure><img :src="job.companyLogo" alt="jobBox"></figure>
                  <div class="sidebar-info">
                    <span class="sidebar-company">{{ job.company }}</span>
                    <span class="card-location">{{ job.companyLocation }}</span>
                    <a class="link-underline mt-15" :href="'#'" v-if="job.openJobs > 0"> {{ job.openJobs }} Open Jobs</a>
                  </div>
                </div>
              </div>
              <div class="sidebar-list-job">
                <div class="box-map">
                  <iframe :src="job.googleMapSrc" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <ul class="ul-disc">
                  <li>{{ job.companyAddress }}</li>
                  <li>Phone: {{ job.companyPhone }}</li>
                  <li>Email: {{ job.companyEmail }}</li>
                </ul>
              </div>
            </div>

            <div class="sidebar-border">
              <h6 class="f-18">Similar jobs</h6>
              <div class="sidebar-list-job">
                <ul>
                  <li v-for="(similarJob, index) in similarJobs" :key="index">
                    <div class="card-list-4 wow animate__animated animate__fadeIn hover-up">
                      <div class="image"><a :href="similarJob.link"><img :src="similarJob.image" alt="jobBox"></a></div>
                      <div class="info-text">
                        <h5 class="font-md font-bold color-brand-1"><a :href="similarJob.link">{{ similarJob.title }}</a></h5>
                        <div class="mt-0"><span class="card-briefcase">{{ similarJob.employmentType }}</span></div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  data() {
    return {
      job: null,
      similarJobs: []
    };
  },
  created() {
    // Fetch job details and similar jobs
    this.fetchJobDetails();
    this.fetchSimilarJobs();
  },
  methods: {
    fetchJobDetails() {
      // Simulated job data for demonstration
      this.job = {
        title: 'Job Title',
        employmentType: 1, // 1 for full-time, 2 for part-time
        postedDate: '2024-07-18T10:30:00Z',
        thumbnail: 'path/to/thumbnail.jpg',
        industry: 'Industry',
        jobLevel: 'Senior',
        salary: {
          min: 50000,
          max: 70000
        },
        experience: {
          min: 5,
          max: 7
        },
        jobType: 'Engineering',
        deadline: '2024-08-15',
        updated: '2024-07-18',
        location: 'New York',
        workplace: 1, // 0 for remote, 1 for office, 2 for hybrid
        company: 'Company Name',
        companyLogo: 'path/to/company_logo.jpg',
        companyLocation: 'New York, USA',
        companyAddress: 'Company Address',
        companyPhone: '+1234567890',
        companyEmail: 'company@example.com',
        companyDescription: 'Description about the company.',
        skills: ['Skill 1', 'Skill 2', 'Skill 3'],
        preferredExperience: ['Preferred Experience 1', 'Preferred Experience 2'],
        position: 'Position Description',
        productKnowledge: 'Product knowledge details.',
        research: 'Research expectations.',
        deliverables: 'Expected deliverables.',
        communication: 'Communication requirements.',
        author: 'Job Author'
      };
    },
    fetchSimilarJobs() {
      // Simulated similar job data for demonstration
      this.similarJobs = [
        {
          title: 'Similar Job Title 1',
          employmentType: 'Full-time',
          link: '#',
          image: 'path/to/image1.jpg'
        },
        {
          title: 'Similar Job Title 2',
          employmentType: 'Part-time',
          link: '#',
          image: 'path/to/image2.jpg'
        },
        {
          title: 'Similar Job Title 3',
          employmentType: 'Full-time',
          link: '#',
          image: 'path/to/image3.jpg'
        }
      ];
    },
    timeAgo(dateString) {
      const date = new Date(dateString);
      const now = new Date();
      const seconds = Math.floor((now - date) / 1000);

      let interval = seconds / 31536000;

      if (interval > 1) {
        return Math.floor(interval) + ' years ago';
      }
      interval = seconds / 2592000;
      if (interval > 1) {
        return Math.floor(interval) + ' months ago';
      }
      interval = seconds / 86400;
      if (interval > 1) {
        return Math.floor(interval) + ' days ago';
      }
      interval = seconds / 3600;
      if (interval > 1) {
        return Math.floor(interval) + ' hours ago';
      }
      interval = seconds / 60;
      if (interval > 1) {
        return Math.floor(interval) + ' minutes ago';
      }
      return Math.floor(seconds) + ' seconds ago';
    }
  }
};
</script>

<style scoped>
/* Add your custom styles here */
</style>
