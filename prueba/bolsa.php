<?php
require_once __DIR__ . '/conexion.php';

// Trae los empleos activos ordenados por los que están más próximos a vencer
$query = "SELECT * FROM empleos WHERE activo = 1 ORDER BY fecha_limite ASC";
$resultado = $conn->query($query);
$total_ofertas = $resultado ? $resultado->num_rows : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bolsa de Trabajo | IESTP José María Arguedas</title>
<meta name="description" content="Encuentra oportunidades laborales y prácticas pre-profesionales para la carrera de Arquitectura de Plataformas y Servicios de TI.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles.css">
<link rel="icon" type="image/png" href="img/logo.png">
<style>
  .countdown-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.78rem;
    font-weight: 700;
    padding: 0.3rem 0.65rem;
    border-radius: 4px;
  }
  .countdown-badge--urgent {
    background-color: #FEE2E2;
    color: #DC2626;
    border: 1px solid #FCA5A5;
  }
  .countdown-badge--normal {
    background-color: #FEF3C7;
    color: #D97706;
    border: 1px solid #FCD34D;
  }
  .countdown-badge--safe {
    background-color: #DCFCE7;
    color: #16A34A;
    border: 1px solid #86EFAC;
  }
  .countdown-badge--expired {
    background-color: #E2E8F0;
    color: #64748B;
    border: 1px solid #CBD5E1;
  }
  .job-card-modern__btn.is-disabled {
    background-color: #94A3B8;
    pointer-events: none;
    cursor: not-allowed;
  }
</style>
</head>
<body class="page-bolsa">

<div class="bolsa-parallax-bg" id="parallaxBg"></div>

<header class="navbar" id="navbar">
  <div class="navbar__inner">
    <a href="index.html#inicio" class="navbar__brand">
      <img src="img/apsti.png" alt="Logo IESTP José María Arguedas" class="navbar__logo-img">
      <span class="navbar__brand-text">
        <strong>IESTP José María Arguedas</strong>
        <small>Arquitectura de Plataformas y Servicios de TI</small>
      </span>
    </a>

    <nav class="navbar__nav" aria-label="Navegación principal">
      <ul>
        <li><a href="index.html#plan-estudios" class="nav-link">Plan de Estudios</a></li>       
        <li><a href="index.html#noticias" class="nav-link">Eventos</a></li>
        <li><a href="bolsa.php" class="nav-link nav-link--external is-active">Bolsa de Trabajo</a></li>
      </ul>
    </nav>

    <button class="navbar__toggle" id="navToggle" aria-label="Abrir menú" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<main class="bolsa-layout">

  <section class="bolsa-hero">
    <div class="bolsa-hero__inner">
      <h1 class="bolsa-hero__title">Conecta con las mejores oportunidades del sector TI</h1>
      <p class="bolsa-hero__subtitle">Portal de empleo y prácticas pre-profesionales exclusivo para estudiantes y egresados de la carrera de Arquitectura de Plataformas y Servicios de TI.</p>
    </div>
  </section>

  <section class="job-board">
    <div class="job-board__inner">
      <div class="job-board__header-bar">
        <span class="job-board__count"><?php echo $total_ofertas; ?> Ofertas encontradas</span>
      </div>
      
      <div class="job-grid">
        <?php if ($resultado && $total_ofertas > 0): ?>
          <?php 
          $hoy = new DateTime();
          while($row = $resultado->fetch_assoc()): 
            $fecha_limite = new DateTime($row['fecha_limite'] . ' 23:59:59');
            $diferencia = $hoy->diff($fecha_limite);
            $expirado = $fecha_limite < $hoy;

            if ($expirado) {
                $tiempo_texto = "Convocatoria finalizada";
                $badge_time_class = "countdown-badge--expired";
            } elseif ($diferencia->days == 0) {
                $tiempo_texto = "¡Últimas " . $diferencia->h . " horas hoy!";
                $badge_time_class = "countdown-badge--urgent";
            } elseif ($diferencia->days == 1) {
                $tiempo_texto = "Queda 1 día restante";
                $badge_time_class = "countdown-badge--urgent";
            } elseif ($diferencia->days <= 5) {
                $tiempo_texto = "Quedan " . $diferencia->days . " días restantes";
                $badge_time_class = "countdown-badge--normal";
            } else {
                $tiempo_texto = "Quedan " . $diferencia->days . " días restantes";
                $badge_time_class = "countdown-badge--safe";
            }
          ?>
            <article class="job-card-modern">
              <div class="job-card-modern__header">
                <div class="job-card-modern__icon">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                </div>
                <div class="job-card-modern__titles">
                  <h3 class="job-card-modern__title"><?php echo htmlspecialchars($row['puesto']); ?></h3>
                  <p class="job-card-modern__company"><?php echo htmlspecialchars($row['empresa']); ?></p>
                </div>
              </div>

              <div class="job-card-modern__details">
                <span class="job-detail">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                  <?php echo htmlspecialchars($row['ubicacion']); ?>
                </span>
                <span class="job-detail">
                  <span class="countdown-badge <?php echo $badge_time_class; ?>">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <?php echo $tiempo_texto; ?> (Cierra: <?php echo date('d/m/Y', strtotime($row['fecha_limite'])); ?>)
                  </span>
                </span>
              </div>

              <div class="job-card-modern__footer">
                <div class="job-card-modern__tags">
                  <span class="job-badge job-badge--type"><?php echo htmlspecialchars($row['tipo']); ?></span>
                </div>
                <?php if ($expirado): ?>
                  <span class="job-card-modern__btn is-disabled">Cerrado</span>
                <?php else: ?>
                  <a href="<?php echo htmlspecialchars($row['whatsapp_url']); ?>" target="_blank" rel="noopener noreferrer" class="job-card-modern__btn">
                    Postular
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                  </a>
                <?php endif; ?>
              </div>
            </article>
          <?php endwhile; ?>
        <?php else: ?>
          <p style="color: #ffffff; grid-column: 1 / -1; text-align: center; padding: 2rem;">No hay ofertas disponibles por el momento.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

</main>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<footer class="footer">
  <div class="footer__inner">
    <div class="footer__about">
      <span class="footer__brand">IESTP José María Arguedas</span>
      <p>Formamos técnicos especialistas en Arquitectura de Plataformas y Servicios de TI, capaces de diseñar, implementar y administrar la infraestructura tecnológica que sostiene a las organizaciones.</p>
    </div>

    <div class="footer__column">
      <h3>Contacto</h3>
      <ul class="footer__list">
        <li>
          <i class="fa-solid fa-phone icon-pink"></i>
          <span style="color: rgba(255, 255, 255, 0.8);">964 868 607</span>
        </li>
        <li>
          <i class="fa-regular fa-envelope icon-light"></i>
          <a href="mailto:informes@iestpjma.edu.pe">informes@iestpjma.edu.pe</a>
        </li>
        <li>
          <i class="fa-solid fa-location-dot icon-pink"></i>
          <span style="color: rgba(255, 255, 255, 0.8);">Av. José María Arguedas S/N, Huancayo, Peru, 12500</span>
        </li>
      </ul>
    </div>

    <div class="footer__column">
      <h3>Síguenos</h3>
      <ul class="footer__list">
        <li>
          <i class="fa-brands fa-facebook icon-fb"></i>
          <a href="https://www.facebook.com/computacionsicaya" target="_blank" rel="noopener noreferrer">Facebook Institucional</a>
        </li>
        <li>
          <i class="fa-brands fa-whatsapp icon-wa"></i>
          <a href="https://wa.me/51945896830" target="_blank" rel="noopener noreferrer">WhatsApp Consultas</a>
        </li>
      </ul>
    </div>
  </div>

  <div class="footer__bottom">
    <p>© 2026 IESTP José María Arguedas. Todos los derechos reservados.</p>
  </div>
</footer>

<script src="script.js"></script>
</body>
</html>
<?php
$conn->close();
?>