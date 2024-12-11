<?php
include_once(__DIR__ . '/conexao.php');
session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--metatags primárias-->
    <title>Barbearia Oliveira</title>
    <meta name="title" content="Barber - Barbers & Hair Cutting" />
    <meta
      name="description"
      content="This is a barber html template made by codewithsadee"
    />

    <!--favicon-->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml" />

    <!--css link-->
    <link rel="stylesheet" href="./assets/css/style.css" />

    <!--google font link-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik:wght@300,400;700&display=swap"
      rel="stylesheet"
    />

    <!--flaticon-->
    <link rel="stylesheet" href="assets/css/flaticon.min.css" />

    <!--pré-carregar imagens-->
    <link rel="preload" as="image" href="./assets/images/hero-banner.jpg" />
  </head>
  <body id="top">
    <!--HEADER-->
    <header class="header">
      <div class="header-top">
        <div class="container">
          <ul class="header-top-list">
            <li class="header-top-item">
              <ion-icon name="call-outline" aria-hidden="true"></ion-icon>
              <p class="item-title">Ligue para nós:</p>
              <a href="tel:48995348547" class="item-link">(48)995348547</a>
            </li>

            <li class="header-top-item">
              <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
              <p class="item-title">Horário de funcionamento:</p>
              <p class="item-text">Segunda - Sábado, 08h - 20h</p>
            </li>

            <li>
              <ul class="social-list">
                <li>
                  <a href="#" class="social-link">
                    <ion-icon name="logo-facebook"></ion-icon>
                  </a>
                </li>

                <li>
                  <a href="#" class="social-link">
                    <ion-icon name="logo-twitter"></ion-icon>
                  </a>
                </li>

                <li>
                  <a href="#" class="social-link">
                    <ion-icon name="logo-youtube"></ion-icon>
                  </a>
                </li>

                <li>
                  <a href="#" class="social-link">
                    <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>

      <div class="header-bottom" data-header>
        <div class="container">
          <a href="#" class="logo">
            Barbearia
            <span class="span">Oliveira</span>
          </a>

          <nav class="navbar container" data-navbar>
            <ul class="navbar-list">
            </ul>
          </nav>

          <?php
        if (isset($_SESSION['id_login'])) {
          echo "Bem-vindo, " . $_SESSION['nome'] . "!";
        } else {
          echo "Você não está logado.";
        }
        ?>

          <button
            class="nav-toggle-btn"
            aria-label="toggle menu"
            data-nav-toggler
          >
            <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
          </button>

          <a href="login.php" class="btn has-before">
            <span class="span">Login</span>

            <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
          </a>

          <a href="logout.php" class="btn has-before">
            <span class="span">Sair</span>

            <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
          </a>
        </div>
      </div>
    </header>

    <main>
      <article>
        <!--HERO-->

        <section
          class="section hero has-before has-bg-image"
          id="home"
          aria-label="home"
          style="background-image: url('./assets/images/hero-banner.jpg')"
        >
          <div class="container">
            <h1 class="h1 hero-title">Barbearia Oliveira</h1>

            <p class="hero-text">
              Transforme seu visual com precisão e relaxamento na Barbearia Oliveira
            , onde cada corte é uma obra-prima de harmonia e estilo!
            </p>

            <a href="agendamento.php" class="btn has-before">
              <span class="span">Agende Seu Horário</span>

              <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
            </a>
            <br>
            <a href="historico_agendamento.php" class="btn has-before">
              <span class="span">Histórico de Agendamento</span>

              <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
            </a>
          </div>
        </section>

        <!--SERVIÇO-->

        <section class="section service" id="services" aria-label="services">
          <div class="container">
            <h2 class="h2 section-title text-center">
              Serviços que oferecemos
            </h2>

            <p class="section-text text-center">
              Descubra uma experiência completa de cuidados masculinos na 
              Barbearia Oliveira: cortes precisos, coloração de cabelo,
              tratamentos faciais e massagens revitalizantes para homens que
              valorizam estilo e bem-estar.
            </p>

            <ul class="grid-list">
              <li>
                <div class="service-card">
                  <div class="card-icon">
                    <i class="flaticon-salon"></i>
                  </div>

                  <h3 class="h3">
                    <a href="#" class="card-title">Estilo de corte de cabelo</a>
                  </h3>

                  <p class="card-text">
                    Descubra o estilo perfeito para cada cliente com nossos
                    cortes de cabelo personalizados, na Barbearia Oliveira.
                  </p>

                  <a href="#" class="card-btn" aria-label="more">
                    <ion-icon
                      name="arrow-forward"
                      aria-hidden="true"
                    ></ion-icon>
                  </a>
                </div>
              </li>

              <li>
                <div class="service-card">
                  <div class="card-icon">
                    <i class="flaticon-shampoo"></i>
                  </div>

                  <h3 class="h3">
                    <a href="#" class="card-title">Lavagem de cabelo</a>
                  </h3>

                  <p class="card-text">
                    Revitalize seu cabelo com nossos tratamentos de lavagem
                    especializados, na Barbearia Oliveira.
                  </p>

                  <a href="#" class="card-btn" aria-label="more">
                    <ion-icon
                      name="arrow-forward"
                      aria-hidden="true"
                    ></ion-icon>
                  </a>
                </div>
              </li>

              <li>
                <div class="service-card">
                  <div class="card-icon">
                    <i class="flaticon-hot-stone"></i>
                  </div>

                  <h3 class="h3">
                    <a href="#" class="card-title">Tratamentos Corporais</a>
                  </h3>

                  <p class="card-text">
                    Relaxe e renove seu corpo com nossos tratamentos corporais
                    especializados, na Barbearia Oliveira.
                  </p>

                  <a href="#" class="card-btn" aria-label="more">
                    <ion-icon
                      name="arrow-forward"
                      aria-hidden="true"
                    ></ion-icon>
                  </a>
                </div>
              </li>

              <li>
                <div class="service-card">
                  <div class="card-icon">
                    <i class="flaticon-treatment"></i>
                  </div>

                  <h3 class="h3">
                    <a href="#" class="card-title">Beleza e Spa</a>
                  </h3>

                  <p class="card-text">
                    Explore o equilíbrio perfeito entre beleza e relaxamento em
                    nosso spa dedicado, na Barbearia Oliveira.
                  </p>

                  <a href="#" class="card-btn" aria-label="more">
                    <ion-icon
                      name="arrow-forward"
                      aria-hidden="true"
                    ></ion-icon>
                  </a>
                </div>
              </li>

              <li>
                <div class="service-card">
                  <div class="card-icon">
                    <i class="flaticon-shaving-razor"></i>
                  </div>

                  <h3 class="h3">
                    <a href="#" class="card-title">Barba</a>
                  </h3>

                  <p class="card-text">
                    Confie em nossos habilidosos estilistas de barbear para
                    criar o visual perfeito para você, na Barbearia Oliveira.
                  </p>

                  <a href="#" class="card-btn" aria-label="more">
                    <ion-icon
                      name="arrow-forward"
                      aria-hidden="true"
                    ></ion-icon>
                  </a>
                </div>
              </li>

              <li>
                <div class="service-card">
                  <div class="card-icon">
                    <i class="flaticon-hair-dye"></i>
                  </div>

                  <h3 class="h3">
                    <a href="#" class="card-title">Várias cores de cabelo</a>
                  </h3>

                  <p class="card-text">
                    Experimente uma variedade de cores de cabelo vibrantes e
                    modernas em nosso salão, na Barbearia Oliveira.
                  </p>

                  <a href="#" class="card-btn" aria-label="more">
                    <ion-icon
                      name="arrow-forward"
                      aria-hidden="true"
                    ></ion-icon>
                  </a>
                </div>
              </li>
            </ul>
          </div>
        </section>


    <!--FOOTER-->

    <footer
      class="footer has-bg-image"
      style="background-image: url('./assets/images/footer-bg.png')"
    >
      <div class="container">
        <div class="footer-top">
          <div class="footer-brand">
            <a href="#" class="logo">
              Barbearia
              <span class="span">Oliveira</span>
            </a>

            <form action="" class="input-wrapper">
              <input
                type="email"
                name="email_address"
                placeholder="Digite seu e-mail"
                required
                class="email-field"
              />

              <button type="submit" class="btn has-before">
                <span class="span">Inscreva-se agora</span>

                <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
              </button>
            </form>
          </div>

          <div class="footer-link-box">
            <ul class="footer-list">
              <li>
                <p class="footer-list-title">Links</p>
              </li>

              <li>
                <a href="#" class="footer-link has-before">Nossos serviços</a>
              </li>

              <li>
                <a href="#" class="footer-link has-before"
                  >Conheça nosso time</a
                >
              </li>

              <li>
                <a href="#" class="footer-link has-before">Nosso portfólio</a>
              </li>

              <li>
                <a href="#" class="footer-link has-before"
                  >Precisa de uma carreira?</a
                >
              </li>

              <li>
                <a href="#" class="footer-link has-before">Notícias e blogs</a>
              </li>
            </ul>

            <ul class="footer-list">
              <li>
                <p class="footer-list-title">Serviços</p>
              </li>

              <li>
                <a href="#" class="footer-link has-before">Corte de cabelo</a>
              </li>

              <li>
                <a href="#" class="footer-link has-before">Barbear e Design</a>
              </li>

              <li>
                <a href="#" class="footer-link has-before">Cores de cabelo</a>
              </li>

              <li>
                <a href="#" class="footer-link has-before">Beleza e Spa</a>
              </li>

              <li>
                <a href="#" class="footer-link has-before"
                  >Massagens Corporais</a
                >
              </li>
            </ul>

            <ul class="footer-list">
              <li>
                <p class="footer-list-title">Notícias recentes</p>
              </li>

              <li>
                <div class="blog-card">
                  <figure
                    class="card-banner img-holder"
                    style="--width: 70; --height: 75"
                  >
                    <img
                      src="./assets/images/footer-blog-1.jpg"
                      width="70"
                      height="75"
                      loading="lazy"
                      alt="The beginners guide to Henna Brows in Brisbane"
                      class="img-cover"
                    />
                  </figure>

                  <div class="card-content">
                    <h3>
                      <a href="#" class="card-title"
                        >O guia para iniciantes em Henna Brows em Brisbane</a
                      >
                    </h3>

                    <div class="card-date">
                      <ion-icon
                        name="calendar-outline"
                        aria-hidden="true"
                      ></ion-icon>

                      <time datetime="2022-08-25">25 de agosto de 2023</time>
                    </div>
                  </div>
                </div>
              </li>

              <li>
                <div class="blog-card">
                  <figure
                    class="card-banner img-holder"
                    style="--width: 70; --height: 75"
                  >
                    <img
                      src="./assets/images/footer-blog-2.jpg"
                      width="70"
                      height="75"
                      loading="lazy"
                      alt="How do I get rid of unwanted hair on my face?"
                      class="img-cover"
                    />
                  </figure>

                  <div class="card-content">
                    <h3>
                      <a href="#" class="card-title"
                        >Como faço para me livrar dos pelos indesejados do
                        rosto?</a
                      >
                    </h3>

                    <div class="card-date">
                      <ion-icon
                        name="calendar-outline"
                        aria-hidden="true"
                      ></ion-icon>

                      <time datetime="2022-08-25">15 de fevereiro de 2024</time>
                    </div>
                  </div>
                </div>
              </li>
            </ul>

            <ul class="footer-list">
              <li>
                <p class="footer-list-title">Entre em Contato</p>
              </li>

              <li class="footer-list-item">
                <ion-icon name="location-outline" aria-hidden="true"></ion-icon>

                <address class="contact-link">
                  Rua Joaquim Nabuco. Bairro Michel, Criciúma (SC)
                </address>
              </li>

              <li class="footer-list-item">
                <ion-icon name="call-outline" aria-hidden="true"></ion-icon>

                <a href="tel:+0123456789" class="contact-link"
                  >+012 (345) 67 89</a
                >
              </li>

              <li class="footer-list-item">
                <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                <span class="contact-link">Segunda - Sábado, 08h - 20h</span>
              </li>

              <li class="footer-list-item">
                <ion-icon name="mail-outline" aria-hidden="true"></ion-icon>

                <a href="mailto:support@gmail.com" class="contact-link"
                  >barbeariaoliveira@gmail.com</a
                >
              </li>
            </ul>
          </div>
        </div>

        <div class="footer-bottom">
          <p>
            Orgulhosamente oferecendo serviços de qualidade desde 2015, na Barbearia Oliveira.
          </p>
        </div>
      </div>
    </footer>

    <!--DE VOLTA AO TOPO-->

    <a
      href="#top"
      class="back-top-btn"
      aria-label="back to top"
      data-back-top-btn
    >
      <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
    </a>

    <!--js link-->
    <script src="./assets/js/script.js" defer></script>

    <!--ionicon link-->
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
  </body>
</html>
