<template>
  <div class="container-cards">
    <div class="container-special">
      <h2 class="section-title" id="break">Lavora con DeliveBoo</h2>
    </div>
    <div class="cards">
      <div class="card-1">
        <div class="img">
          <img
            src="https://cwa.roocdn.com/_next/static/riders.6856d560.jpg"
            alt="rider"
          />

          <div class="card-txt">
            <h4>Rider</h4>

            <p>
              Diventa un rider: flessibilità, ottimi guadagni e un mondo di
              vantaggi per te
            </p>

            <div class="btn">
              <button>
                Coming soon
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="card-2">
        <div class="img">
          <img
            src="https://cwa.roocdn.com/_next/static/restaurants.2a02d1a0.jpg"
            alt="ristoranti"
          />

          <div class="card-txt">
            <h4>Ristoranti</h4>

            <p>
              Diventa partner di DeliveBoo e raggiungi sempre più clienti. Ci
              occupiamo noi della consegna, così che la tua unica preoccupazione
              sia continuare a preparare il miglior cibo.
            </p>

            <div class="btn">
              <button>
                <a href="http://127.0.0.1:8000/register" target="_blank">
                  Diventa nostro partner
                </a>
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="card-3">
        <div class="img">
          <img
            src="https://cwa.roocdn.com/_next/static/team.86d7b512.jpg"
            alt="lavora con noi"
          />

          <div class="card-txt">
            <h4>Lavora con noi</h4>

            <p>
              La nostra missione è trasformare il modo in cui le persone
              mangiano. È un obiettivo ambizioso, come noi, e ci servono persone
              che ci aiutino a raggiungerlo.
            </p>

            <div class="btn">
              <button>
                Coming soon
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Workers",
};
</script>

<style scoped lang="scss">
@import "@/style/workers.scss";
</style>
