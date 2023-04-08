<template>
  <div class="container">
    <button @click="goBack">
      <i class="fa fa-arrow-left-long"></i>&nbsp;&nbsp; Nazad
    </button>
    <Loader :loading="isLoading" />
    <div v-if="country" class="row justify-content-between">
      <div
        class="col-5 col-sm-12"
        data-aos="fade-right"
        data-aos-duration="800"
        data-aos-delay="1000"
      >
        <img :src="country.flag" alt="flag" />
      </div>
      <div
        class="col-6 col-sm-12"
        data-aos="fade-left"
        data-aos-duration="800"
        data-aos-delay="1000"
      >
        <h1>{{ country.name }}</h1>
        <div class="row country-details">
          <div class="col-6 col-sm-12">
            <p>
              <span class="fw-600">Populacija: </span
              >{{ country.population.toLocaleString() }}
            </p>
            <p><span class="fw-600">Kontinet: </span>{{ country.region }}</p>
            <p v-if="country.capital">
              <span class="fw-600">Glavni Grad: </span>{{ country.capital }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { computed, onMounted, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import Loader from "@/components/Loader.vue";

export default {
  name: "CountryDetailsView",
  setup() {
    const route = useRoute();
    const router = useRouter();
    const countryName = ref(route.params.name);
    const isLoading = ref(false);
    let country = ref(null);

    const fetchCountryData = () => {
      try {
        isLoading.value = true;

        country.value = [
          {
            name: "Afghanistan",
            capital: "Kabul",
            region: "Asia",
            population: 40218234,
            flag: "https://upload.wikimedia.org/wikipedia/commons/5/5c/Flag_of_the_Taliban.svg",
            independent: false,
          },
          {
            name: "Åland Islands",
            capital: "Mariehamn",
            region: "Europe",
            population: 28875,
            flag: "https://flagcdn.com/ax.svg",
            independent: false,
          },
          {
            name: "Albania",
            capital: "Tirana",
            region: "Europe",
            population: 2837743,
            flag: "https://flagcdn.com/al.svg",
            independent: false,
          },
          {
            name: "Algeria",
            capital: "Algiers",
            region: "Africa",
            population: 44700000,
            flag: "https://flagcdn.com/dz.svg",
            independent: false,
          },
          {
            name: "American Samoa",
            capital: "Pago Pago",
            region: "Oceania",
            population: 55197,
            flag: "https://flagcdn.com/as.svg",
            independent: false,
          },
          {
            name: "Andorra",
            capital: "Andorra la Vella",
            region: "Europe",
            population: 77265,
            flag: "https://flagcdn.com/ad.svg",
            independent: false,
          },
        ].filter((item) => item.name === countryName.value)[0];
      } catch (error) {
        alert("Couldn't fetch country data!");
      } finally {
        isLoading.value = false;
      }
    };

    onMounted(() => {
      fetchCountryData();
    });

    watch(
      () => route.params.name,
      () => {
        if (route.params.name) {
          countryName.value = route.params.name;
          fetchCountryData();
        }
      }
    );

    const countryCurrencies = computed(() => {
      return country.value.currencies
        .map((currency) => currency.name)
        .join(", ");
    });

    const countryLanguages = computed(() => {
      return country.value.languages
        .map((language) => language.name)
        .join(", ");
    });

    const goBack = () => {
      router.back();
    };

    return {
      isLoading,
      goBack,
      country,
      countryCurrencies,
      countryLanguages,
    };
  },
  components: { Loader },
};
</script>

<style lang="scss" scoped>
@import "@/assets/scss/mixins";

.container {
  font-size: 16px !important;
  padding: 3rem var(--x-gutter) 0 var(--x-gutter);

  button {
    @include element-style;

    border: none;
    padding: 0.75rem 2rem;
    color: var(--text-color);
    cursor: pointer;
    transition: opacity 0.3s ease-in-out;

    &:hover {
      opacity: 0.8;
    }
  }

  & > div.row {
    margin-top: 3rem;
    overflow: hidden;

    img {
      width: 100%;
      height: auto;
      max-height: 22rem;
      box-shadow: 0 0 1rem 0.5rem rgba(0, 0, 0, 0.2);

      @media (max-width: 767px) {
        & {
          margin-bottom: 2rem;
        }
      }
    }

    .country-details {
      & > div {
        margin-top: 2rem;
        align-content: center;

        p {
          margin-bottom: 0.75rem;
        }
      }

      .border-countries {
        margin: 2rem 0;
        display: flex;
        align-items: center;
        max-width: 100%;
        white-space: nowrap;
        position: relative;

        @media (max-width: 767px) {
          & {
            flex-direction: column;
            align-items: flex-start;
          }
        }

        &::after {
          content: "";
          position: absolute;
          top: 0;
          right: 0;
          width: 2rem;
          height: 100%;
          background: linear-gradient(
            to right,
            var(--fade-color) 0%,
            var(--background-color) 100%
          );
        }

        & > span {
          margin-right: 1rem;
        }

        .border-countries-list {
          display: flex;
          align-items: center;
          overflow: auto;

          &::-webkit-scrollbar {
            height: 0;
          }

          span {
            @include element-style;
            border-radius: 2px;
            display: block;
            padding: 0.25rem 1rem;
            margin: 0 0.5rem;
          }

          @media (max-width: 767px) {
            & {
              margin-top: 1rem;
              max-width: 100%;

              span {
                margin: 0;
                margin-right: 1rem;
              }
            }
          }
        }
      }
    }
  }
}
</style>
