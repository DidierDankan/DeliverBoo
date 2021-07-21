<template>
  <div class="container-cards">
    <h2 class="section-title">Lavora con DeliveBoo</h2>
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
.container-cards {
  max-width: 1170px;
  margin: 0 auto;
  padding: 40px 0px 40px 0px;
  .section-title {
    color: #2e3333;
    margin-bottom: 30px;
    font-size: 35px;
  }
  .cards {
    display: grid;
    grid-template-columns: 6fr;

    .card-1 {
      display: flex;
      background-color: #ff483b;
      .img {
        display: flex;
        flex-direction: column;
        img {
          width: 100%;
        }
      }
      .card-txt {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 10px;
        flex-grow: 1;
        color: #fff;
        h4 {
          font-size: 40px;
        }
        p {
          margin-bottom: 5px;
        }
        .btn {
          button {
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: not-allowed;
            font-size: 16px;
            min-height: 48px;
            padding: 12px 24px;
            color: #fff;
            background: #00ccbc;
          }
        }
      }
    }
    .card-2 {
      display: flex;
      background-color: #ff8100;
      .img {
        display: flex;
        flex-direction: column;
        img {
          width: 100%;
        }
      }
      .card-txt {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 10px;
        flex-grow: 1;
        color: #fff;
        h4 {
          font-size: 40px;
        }
        p {
          margin-bottom: 5px;
        }
        .btn {
          button {
            a {
              text-decoration: none;
              font-size: 16px;
              color: #fff;
              font-weight: 600;
            }
            border: none;
            border-radius: 4px;
            cursor: pointer;
            min-height: 48px;
            padding: 12px 24px;
            background: #00ccbc;
            transition: background 1s;
            &:hover {
              background: #04978b;
            }
          }
        }
      }
    }

    .card-3 {
      display: flex;
      background-color: #bac3c3;
      .img {
        display: flex;
        flex-direction: column;
        img {
          width: 100%;
        }
      }
      .card-txt {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-grow: 1;
        padding: 10px;
        color: #fff;
        h4 {
          font-size: 40px;
        }
        p {
          margin-bottom: 5px;
        }
        .btn {
          button {
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: not-allowed;
            font-size: 16px;
            min-height: 48px;
            padding: 12px 24px;
            color: #fff;
            background: #00ccbc;
          }
        }
      }
    }
  }

  @media screen and (min-width: 768px) {
    .cards {
      grid-template-columns: 5fr 5fr 5fr;
      .card-2 {
        .card-txt {
          .btn {
            button {
              padding: 5px 24px;
            }
          }
        }
      }
      .card-1,
      .card-2,
      .card-3 {
        .card-txt {
          h4 {
            font-size: 30px;
          }
          p {
            font-size: 13px;
          }
        }
      }
    }
  }
  
  @media screen and (min-width: 1170px) {
    .container-cards {
      .section-title {
        margin-left: 87px;
      }
    }
    .cards {
      grid-template-columns: 5fr 5fr 5fr;
      .card-1,
      .card-2,
      .card-3 {
        .card-txt {
          h4 {
            font-size: 25px;
          }
          p {
            font-size: 14px;
          }
        }
      }
      .card-2 {
        .btn {
          button {
            padding: 5px 24px;
          }
        }
      }
    }
  }
}
</style>
