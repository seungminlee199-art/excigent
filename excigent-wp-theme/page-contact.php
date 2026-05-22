<?php
/**
 * Template Name: Contact
 * Template Post Type: page
 */
get_header(); ?>

<style>
.contact-grid{display:grid;grid-template-columns:1fr 1.2fr;gap:5rem;align-items:start}
.contact-info-heading{font-size:1.5rem;font-weight:600;color:var(--navy);margin-bottom:.6rem}
.contact-info-sub{font-size:.98rem;line-height:1.72;color:var(--muted);margin-bottom:2.5rem}
.contact-cards{display:flex;flex-direction:column;gap:1rem}
.contact-card{display:flex;align-items:flex-start;gap:1rem;padding:1.4rem;border-radius:14px;border:1px solid rgba(0,69,105,.10);background:#fff;transition:transform .3s cubic-bezier(.22,1,.36,1),box-shadow .3s ease,border-color .3s ease}
.contact-card:hover{transform:translateY(-3px);border-color:rgba(0,97,179,.25);box-shadow:0 12px 36px -18px rgba(0,69,105,.24)}
.contact-card-icon{width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,rgba(0,97,179,.10),rgba(0,69,105,.06));display:flex;align-items:center;justify-content:center;flex-shrink:0}
.contact-card-icon svg{width:20px;height:20px;stroke:var(--navy);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
.contact-card-label{font-size:.68rem;font-weight:700;letter-spacing:.2em;text-transform:uppercase;color:var(--blue);margin-bottom:.25rem}
.contact-card-value{font-size:.96rem;font-weight:500;color:var(--navy)}
.contact-card-value a{color:var(--navy);text-decoration:none;transition:color .2s}
.contact-card-value a:hover{color:var(--blue)}
.contact-regions{margin-top:2.4rem}
.contact-regions-title{font-size:.72rem;font-weight:700;letter-spacing:.2em;text-transform:uppercase;color:var(--muted);margin-bottom:1rem}
.contact-region-list{list-style:none;display:flex;flex-direction:column;gap:.6rem}
.contact-region-list li{display:flex;align-items:center;gap:.75rem;font-size:.92rem;color:var(--navy)}
.contact-region-dot{width:8px;height:8px;border-radius:50%;background:var(--blue);flex-shrink:0}
.contact-form-col{position:sticky;top:88px}
.contact-form-wrap{background:linear-gradient(180deg,#fff 0%,#F4F7FB 100%);border:1px solid rgba(0,69,105,.10);border-radius:22px;padding:2.8rem 2.4rem;box-shadow:0 8px 40px -18px rgba(0,69,105,.18)}
.contact-form-wrap h3{font-size:1.4rem;font-weight:600;color:var(--navy);margin-bottom:.4rem}
.contact-form-wrap p{font-size:.92rem;color:var(--muted);margin-bottom:2rem;line-height:1.65}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem}
.form-group{display:flex;flex-direction:column;gap:.4rem;margin-bottom:1rem}
.form-group label{font-size:.72rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--navy)}
.form-group input,.form-group select,.form-group textarea{width:100%;padding:.75rem 1rem;border:1px solid rgba(0,69,105,.16);border-radius:8px;font-family:inherit;font-size:.94rem;color:var(--navy);background:#fff;outline:none;transition:border-color .2s,box-shadow .2s}
.form-group input:focus,.form-group select:focus,.form-group textarea:focus{border-color:var(--blue);box-shadow:0 0 0 3px rgba(0,97,179,.10)}
.form-group input::placeholder,.form-group textarea::placeholder{color:var(--muted);opacity:.7}
.form-group select{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%235a7a8f' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right .9rem center;background-size:16px;padding-right:2.5rem}
.form-group textarea{resize:vertical;min-height:120px}
.form-submit{width:100%;padding:.9rem;background:var(--navy);color:#fff;border:none;border-radius:8px;font-family:inherit;font-size:.86rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;cursor:pointer;transition:background .2s,transform .15s}
.form-submit:hover{background:var(--blue);transform:translateY(-1px)}
.form-note{font-size:.76rem;color:var(--muted);text-align:center;margin-top:.9rem}
.form-success{display:none;text-align:center;padding:2rem 0}
.form-success-icon{width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,#0061B3,#B8DBFF);margin:0 auto 1.2rem;display:flex;align-items:center;justify-content:center}
.form-success-icon svg{width:28px;height:28px;stroke:#fff;stroke-width:2.5;fill:none}
.form-success h4{font-size:1.4rem;font-weight:600;color:var(--navy);margin-bottom:.5rem}
.form-success p{font-size:.94rem;color:var(--muted)}
@media (max-width:980px){.contact-grid{grid-template-columns:1fr;gap:3rem}.contact-form-col{position:static}.form-row{grid-template-columns:1fr}}
</style>

<header class="page-hero">
  <div class="page-hero-inner">
    <span class="eyebrow"><span class="eyebrow-dot"></span>Connect With Us</span>
    <h1>Let's talk about<br><strong>your market opportunity</strong>.</h1>
    <p>Whether you're a principal looking to expand into new markets, or a channel partner wanting to learn more about our represented brands — we'd love to hear from you.</p>
  </div>
</header>

<section class="section light">
  <div class="section-inner">
    <div class="contact-grid">

      <!-- INFO COL -->
      <div class="contact-info-col">
        <h2 class="contact-info-heading reveal"><?php echo esc_html( function_exists('get_field') ? (get_field('contact_col_heading') ?: 'Get in touch') : 'Get in touch' ); ?></h2>
        <p class="contact-info-sub reveal"><?php echo esc_html( function_exists('get_field') ? (get_field('contact_col_subtext') ?: 'We\'re always open to conversations with principals, channel partners, and industry professionals.') : 'We\'re always open to conversations with principals, channel partners, and industry professionals.' ); ?></p>

        <div class="contact-cards">
          <?php
          $email = esc_html( get_theme_mod('excigent_email','hello@excigent.com') );
          $phone = esc_html( get_theme_mod('excigent_phone','+1 (800) 000-0000') );
          $phone_raw = preg_replace('/[^0-9+]/', '', get_theme_mod('excigent_phone','+18000000000') );
          ?>
          <div class="contact-card reveal">
            <div class="contact-card-icon"><svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
            <div class="contact-card-body">
              <div class="contact-card-label">Email</div>
              <div class="contact-card-value"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div>
            </div>
          </div>
          <div class="contact-card reveal" style="--d:.06s">
            <div class="contact-card-icon"><svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.42 2 2 0 0 1 3.59 1.22h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.13 6.13l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>
            <div class="contact-card-body">
              <div class="contact-card-label">Phone</div>
              <div class="contact-card-value"><a href="tel:<?php echo $phone_raw; ?>"><?php echo $phone; ?></a></div>
            </div>
          </div>
          <div class="contact-card reveal" style="--d:.12s">
            <div class="contact-card-icon"><svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
            <div class="contact-card-body">
              <div class="contact-card-label">Coverage</div>
              <div class="contact-card-value">Serving North America · Latin America · Caribbean</div>
            </div>
          </div>
        </div>

        <div class="contact-regions reveal" style="--d:.18s">
          <div class="contact-regions-title">Geographic Reach</div>
          <ul class="contact-region-list">
            <li><span class="contact-region-dot"></span>North America — USA · Canada · Mexico</li>
            <li><span class="contact-region-dot"></span>Latin America — Central &amp; South America</li>
            <li><span class="contact-region-dot"></span>Caribbean — Greater &amp; Lesser Antilles</li>
          </ul>
        </div>
      </div><!-- /info col -->

      <!-- FORM COL -->
      <div class="contact-form-col reveal" style="--d:.08s">
        <div class="contact-form-wrap">
          <h3>Start a Conversation</h3>
          <p>Tell us about your company and what you're looking to achieve. We'll be in touch within one business day.</p>
          <form id="contactForm" onsubmit="return excigentContactSubmit(event)">
            <div class="form-row">
              <div class="form-group">
                <label for="cf_first">First Name *</label>
                <input id="cf_first" type="text" placeholder="John" required />
              </div>
              <div class="form-group">
                <label for="cf_last">Last Name *</label>
                <input id="cf_last" type="text" placeholder="Smith" required />
              </div>
            </div>
            <div class="form-group">
              <label for="cf_email">Email Address *</label>
              <input id="cf_email" type="email" placeholder="john@company.com" required />
            </div>
            <div class="form-group">
              <label for="cf_company">Company</label>
              <input id="cf_company" type="text" placeholder="Your Company" />
            </div>
            <div class="form-group">
              <label for="cf_subject">What brings you here?</label>
              <select id="cf_subject">
                <option value="">Select a topic…</option>
                <option>Principal / Manufacturer Inquiry</option>
                <option>Channel Partner Inquiry</option>
                <option>Market Development Discussion</option>
                <option>Media / Press Inquiry</option>
                <option>General Inquiry</option>
              </select>
            </div>
            <div class="form-group">
              <label for="cf_message">Message *</label>
              <textarea id="cf_message" placeholder="Tell us about your company and goals…" required></textarea>
            </div>
            <?php wp_nonce_field( 'excigent_contact', 'excigent_nonce' ); ?>
            <button type="submit" class="form-submit">Send Message</button>
            <p class="form-note">We respect your privacy. Your information is never shared or sold.</p>
          </form>
          <div class="form-success" id="formSuccess">
            <div class="form-success-icon"><svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg></div>
            <h4>Message Sent!</h4>
            <p>Thank you for reaching out. We'll be in touch within one business day.</p>
          </div>
        </div>
      </div><!-- /form col -->

    </div><!-- .contact-grid -->
  </div>
</section>

<script>
function excigentContactSubmit(e) {
  e.preventDefault();
  document.getElementById('contactForm').style.display = 'none';
  document.getElementById('formSuccess').style.display = 'block';
  return false;
}
</script>

<?php get_footer(); ?>
