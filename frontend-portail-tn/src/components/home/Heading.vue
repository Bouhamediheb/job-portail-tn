<template>
    <div class="bg-homepage4"></div>
    <section class="section-box">
        <div class="banner-hero hero-1 banner-homepage4">
            <div class="banner-inner">
                <div class="row">
                    <div class="col-xl-7 col-lg-12">
                        <div class="block-banner">
                            <h1 class="heading-banner wow animate__animated animate__fadeInUp">
                                Trouvez le <span class="color-brand-2">travail/stage</span><br
                                    class="d-none d-lg-block">de vos rêves
                            </h1>
                            <div class="banner-description mt-20 wow animate__animated animate__fadeInUp">
                                Chaque mois, plus de 3 millions de chercheurs d'emploi se tournent
                                <br class="d-none d-lg-block">vers notre site dans leur recherche de travail.
                            </div>
                            <div class="form-find mt-40 wow animate__animated animate__fadeIn no-border">
                                <form @submit.prevent="submitSearch">
                                    <select v-model="selectedDomain"
                                        class="form-input mr-10 select-active input-industry no-border" id="domain"
                                        ref="domainSelect">
                                        <option value="" disabled>Domaine</option>
                                        <option v-for="domain in domains" :key="domain" :value="domain">{{ domain }}
                                        </option>
                                    </select>

                                    <select v-model="selectedLocation"
                                        class="form-input mr-10 select-active input-location no-border" id="location"
                                        ref="locationSelect">
                                        <option value="" disabled>Localisation</option>
                                        <option value="Ariana">Ariana</option>
                                        <option value="Béja">Béja</option>
                                        <option value="Ben Arous">Ben Arous</option>
                                        <option value="Bizerte">Bizerte</option>
                                        <option value="Gabès">Gabès</option>
                                        <option value="Gafsa">Gafsa</option>
                                        <option value="Jendouba">Jendouba</option>
                                        <option value="Kairouan">Kairouan</option>
                                        <option value="Kasserine">Kasserine</option>
                                        <option value="Kébili">Kébili</option>
                                        <option value="Le Kef">Le Kef</option>
                                        <option value="Mahdia">Mahdia</option>
                                        <option value="Manouba">Manouba</option>
                                        <option value="Medenine">Medenine</option>
                                        <option value="Monastir">Monastir</option>
                                        <option value="Nabeul">Nabeul</option>
                                        <option value="Sfax">Sfax</option>
                                        <option value="Sidi Bouzid">Sidi Bouzid</option>
                                        <option value="Siliana">Siliana</option>
                                        <option value="Sousse">Sousse</option>
                                        <option value="Tataouine">Tataouine</option>
                                        <option value="Tunis">Tunis</option>
                                        <option value="Zaghouan">Zaghouan</option>


                                    </select>

                                    <input v-model="keywords" class="form-input input-keysearch mr-10" type="text"
                                        placeholder="Mots clés ..">
                                    <button class="btn btn-default btn-find font-sm"
                                        @click="submitSearch">Recherche</button>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-12 d-none d-xl-block col-md-6">
                        <div class="banner-imgs">
                            <div class="block-1 shape-1"><img class="img-responsive" alt="PortailTN"
                                    src="/assets/home/imgs/page/homepage4/banner.png"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Heading',
    data() {
        return {
            selectedDomain: '',
            selectedLocation: '',
            keywords: '',
            domains: [] // Array to hold the domain options
        };
    },
    async created() {
        await this.getDomains(); // Fetch domains when the component is created
    },
    methods: {
        async getDomains() {
            try {
                const response = await axios.get("http://localhost:8000/api/onlyjobs");
                const allDomains = response.data.map((job) => job.domain);
                this.domains = [...new Set(allDomains)];
                console.log('Fetched Domains:', this.domains);
            } catch (error) {
                console.error("Error fetching domains:", error);
            }
        },
        submitSearch() {
            // Access the select elements using refs
            const selectedLocation = this.$refs.locationSelect.value;
            const selectedDomain = this.$refs.domainSelect.value;

            // Construct the search parameters
            const searchParams = {
                domain: selectedDomain,
                location: selectedLocation,
                keywords: this.keywords
            };

            console.log('Selected Domain:', selectedDomain);
            console.log('Selected Location:', selectedLocation);
            console.log('Search Parameters:', searchParams);

            this.$router.push({ name: 'JobList', query: searchParams });
        }
    }
}
</script>

<style scoped>
.no-border {
    border: none !important;
}
</style>
