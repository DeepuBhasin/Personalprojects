<template>
  <div
    class="row countries-list"
    data-aos="fade-up"
    data-aos-duration="800"
    data-aos-delay="1000"
  >
    <div
      v-for="country in countries"
      :key="country.name"
      class="col-3 col-md-4 col-sm-12 gap-3"
    >
      <router-link
        :to="{ name: 'country-details', params: { name: country.name } }"
      >
        <article class="card">
          <div class="card-image">
            <img :src="country.flag" :alt="country.name + ' flag'" />
          </div>
          <div class="card-details">
            <h2>{{ country.name }}</h2>
            <div>
              <p>
                <span class="fw-600">Populacija:</span>
                {{ country.population.toLocaleString() }}
              </p>
              <p><span class="fw-600">Kontinent:</span> {{ country.region }}</p>
              <p v-if="country.capital">
                <span class="fw-600">Glavni grad:</span> {{ country.capital }}
              </p>
            </div>
          </div>
        </article>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "countries-list-component",
  props: ["countries"],
};
</script>

<style lang="scss" scoped>
.countries-list {
  margin: 3rem calc(var(--x-gutter) - 30px);
  margin-bottom: 1rem;

  & > div {
    margin-bottom: 50px;

    p {
      margin-bottom: 0.25rem;
    }
  }
}

@media (max-width: 767px) {
  .countries-list {
    margin: 3rem var(--x-gutter);
  }
}
</style>
