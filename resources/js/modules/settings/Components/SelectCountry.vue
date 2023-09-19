<template>
  <div class="country__container">
    <div class="select__block" @click="isOpenSelect = !isOpenSelect">
      <div class="country__block">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" viewBox="0 0 22 16" fill="none">
          <g clip-path="url(#clip0_666_7376)">
          <rect width="22" height="16" rx="2" fill="#1A47B8"/>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M0 10.668H22V16.0013H0V10.668Z" fill="#F93939"/>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H22V5.33333H0V0Z" fill="white"/>
          </g>
          <defs>
          <clipPath id="clip0_666_7376">
          <rect width="22" height="16" rx="2" fill="white"/>
          </clipPath>
          </defs>
        </svg> 
        <span class="current-country">Россия</span>  
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
       <path d="M18 9.00005C18 9.00005 13.5811 15 12 15C10.4188 15 6 9 6 9" stroke="#D0D5DD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
    <div class="choose-country__block" v-if="isOpenSelect">
      <div class="input_container">
        <div class="svg_container">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M14 14L16.5 16.5M21.5667 21.5667C20.9891 22.1444 20.0525 22.1444 19.4748 21.5667L16.4333 18.5252C15.8556 17.9475 15.8556 17.0109 16.4333 16.4333C17.0109 15.8556 17.9475 15.8556 18.5252 16.4333L21.5667 19.4748C22.1444 20.0525 22.1444 20.9891 21.5667 21.5667ZM16 9C16 5.13401 12.866 2 9 2C5.13401 2 2 5.13401 2 9C2 12.866 5.13401 16 9 16C12.866 16 16 12.866 16 9Z" stroke="#98A2B3" stroke-width="1.5" stroke-linejoin="round"/>
          </svg>
        </div>
        <input class="search-input" placeholder="Поиск страны">
      </div>
      <div class="item__block">
        <div v-for="country in countries" class="country_item">
          <div v-html="country.svg"></div>
          <span>{{ country.text }}</span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
    data() {
        return {
          countries: [
            {
              svg: `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" viewBox="0 0 22 16" fill="none">
                  <g clip-path="url(#clip0_666_2501)">
                    <path d="M19.9048 0H2.09524C0.93807 0 0 0.955126 0 2.13333V13.8667C0 15.0449 0.93807 16 2.09524 16H19.9048C21.0619 16 22 15.0449 22 13.8667V2.13333C22 0.955126 21.0619 0 19.9048 0Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 11H22V16H0V11ZM0 0H22V5H0V0Z" fill="#3ECBF8"/>
                    <path d="M10.9999 9.59844C11.8678 9.59844 12.5713 8.88209 12.5713 7.99844C12.5713 7.11478 11.8678 6.39844 10.9999 6.39844C10.132 6.39844 9.42847 7.11478 9.42847 7.99844C9.42847 8.88209 10.132 9.59844 10.9999 9.59844Z" fill="#FFDA2C"/>
                  </g>
                  <defs>
                    <clipPath id="clip0_666_2501">
                      <rect width="22" height="16" rx="2" fill="white"/>
                    </clipPath>
                  </defs>
                </svg>`,
              text: "Аргентина",
            },
            {
              svg: `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" viewBox="0 0 22 16" fill="none">
                    <g clip-path="url(#clip0_666_15963)">
                      <path d="M19.9048 0H2.09524C0.93807 0 0 0.955126 0 2.13333V13.8667C0 15.0449 0.93807 16 2.09524 16H19.9048C21.0619 16 22 15.0449 22 13.8667V2.13333C22 0.955126 21.0619 0 19.9048 0Z" fill="#FFDA2C"/>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H7V16H0V0Z" fill="#151515"/>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M15 0H22V16H15V0Z" fill="#F93939"/>
                    </g>
                    <defs>
                      <clipPath id="clip0_666_15963">
                        <rect width="22" height="16" rx="2" fill="white"/>
                      </clipPath>
                    </defs>
                  </svg>`,
              text: "Германия",
            },
            {
              svg: `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" viewBox="0 0 22 16" fill="none">
                  <g clip-path="url(#clip0_666_16822)">
                    <rect width="22" height="16" rx="2" fill="#1A47B8"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 10.668H22V16.0013H0V10.668Z" fill="#F93939"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H22V5.33333H0V0Z" fill="white"/>
                  </g>
                  <defs>
                    <clipPath id="clip0_666_16822">
                      <rect width="22" height="16" rx="2" fill="white"/>
                    </clipPath>
                  </defs>
                </svg>`,
              text: "Россия",
            },
          ],
          isOpenSelect: false,
        };
     },
}
</script>
<style scoped>
.select__block{
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-radius: 12px;
  padding: 16px;
  background: var(--background-island-day, #FFF);
  box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
  margin-bottom: 4px;
}
.country_item{
  display: flex;
  gap: 8px;
  padding: 16px 16px 16px 12px;
}
.country_item:hover{
  border-radius: var(--surface-border-radius-radius-s-md, 12px);
background: var(--old-primary-4007, rgba(83, 177, 253, 0.07));
}
.item__block{
  padding: 4px;
}
.current-country{
  color: var(--old-light-gray-600, #475467);
  font-family: NunitoSans;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 24px; /* 150% */
}
.country__block{
  display: flex;
  align-items: center;
  gap: 8px;
}
.country__container{
  position: relative;
}
.choose-country__block{
  border-radius: var(--surface-border-radius-radius-s-md, 12px);
  background: var(--main-gohan, #FFF);
  box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.05);
  width: 480px;
  padding-bottom: var(--gap-0, 0px);
  gap: var(--gap-0, 4px);
}
.input_container{
  position: relative;
  border-bottom: 1px solid var(--old-light-gray-200, #E4E7EC);
}
.svg_container{
  position: absolute;
  top: 16px;
  left: 16px;
}
.search-input{
  /* width: 100%; */
  margin-left: 52px;
  padding:  16px 16px 16px 0;
  font-family: NunitoSans;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 24px; /* 150% */
  outline: none;
}
</style>