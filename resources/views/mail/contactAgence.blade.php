<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nouvelle demande de contact</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7fa;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f7fa; padding: 40px 0;">
    <tr>
      <td align="center">
        <!-- Container principal -->
        <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">

          <!-- Header avec gradient -->
          <tr>
            <td style="background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%); padding: 40px 30px; text-align: center;">
              <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 700;">
                 Nouvelle Demande de Contact
              </h1>
              <p style="margin: 10px 0 0 0; color: #ffffff; font-size: 14px; opacity: 0.9;">
                Un client est intéressé par votre propriété
              </p>
            </td>
          </tr>

          <!-- Notification -->
          <tr>
            <td style="padding: 30px; background-color: #fff3cd; border-left: 5px solid #ffc107;">
              <p style="margin: 0; color: #856404; font-size: 14px;">
                <strong>⚡ Action requise :</strong> Un client potentiel souhaite obtenir plus d'informations sur votre bien immobilier.
              </p>
            </td>
          </tr>

          <!-- Salutation -->
          <tr>
            <td style="padding: 30px 30px 20px 30px;">
              <p style="margin: 0; font-size: 16px; color: #333; line-height: 1.6;">
                Bonjour <strong style="color: #ff6b35;">{{ $agencyName }}</strong>,
              </p>
              <p style="margin: 15px 0 0 0; font-size: 16px; color: #555; line-height: 1.6;">
                Vous avez reçu une nouvelle demande de contact concernant l'une de vos propriétés. Voici les détails :
              </p>
            </td>
          </tr>

          <!-- Informations du bien -->
          <tr>
            <td style="padding: 0 30px;">
              <table width="100%" cellpadding="0" cellspacing="0" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border-radius: 15px; padding: 25px;">
                <tr>
                  <td>
                    <h3 style="margin: 0 0 15px 0; color: #ff6b35; font-size: 18px; font-weight: 700;">
                       Propriété concernée
                    </h3>
                    <table width="100%" cellpadding="8" cellspacing="0">
                      <tr>
                        <td style="color: #666; font-size: 14px; width: 140px;">
                          <strong>Titre :</strong>
                        </td>
                        <td style="color: #333; font-size: 14px;">
                          {{ $propertyTitle }}
                        </td>
                      </tr>
                      <tr>
                        <td style="color: #666; font-size: 14px;">
                          <strong>Référence :</strong>
                        </td>
                        <td style="color: #333; font-size: 14px;">
                          {{ $propertyRef }}
                        </td>
                      </tr>
                      <tr>
                        <td style="color: #666; font-size: 14px;">
                          <strong>Adresse :</strong>
                        </td>
                        <td style="color: #333; font-size: 14px;">
                          {{ $propertyAddress }}
                        </td>
                      </tr>
                      <tr>
                        <td style="color: #666; font-size: 14px;">
                          <strong>Prix :</strong>
                        </td>
                        <td style="color: #ff6b35; font-size: 16px; font-weight: 700;">
                          {{ $propertyPrice }}
                        </td>
                      </tr>
                      <tr>
                        <td style="color: #666; font-size: 14px;">
                          <strong>Type :</strong>
                        </td>
                        <td>
                          <span style="background-color: {{ $propertyType == 'Vente' ? '#28a745' : '#007bff' }}; color: white; padding: 5px 12px; border-radius: 15px; font-size: 12px; font-weight: 600;">
                            {{ $propertyType }}
                          </span>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Informations du client -->
          <tr>
            <td style="padding: 25px 30px 0 30px;">
              <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8f9fa; border-radius: 15px; padding: 25px; border: 2px solid #e9ecef;">
                <tr>
                  <td>
                    <h3 style="margin: 0 0 15px 0; color: #333; font-size: 18px; font-weight: 700;">
                      👤 Informations du client
                    </h3>
                    <table width="100%" cellpadding="8" cellspacing="0">
                      <tr>
                        <td style="color: #666; font-size: 14px; width: 140px;">
                          <strong>Nom :</strong>
                        </td>
                        <td style="color: #333; font-size: 14px; font-weight: 600;">
                          {{ $clientName }}
                        </td>
                      </tr>
                      <tr>
                        <td style="color: #666; font-size: 14px;">
                          <strong>Email :</strong>
                        </td>
                        <td>
                          <a href="mailto:{{ $clientEmail }}" style="color: #ff6b35; text-decoration: none; font-size: 14px;">
                            {{ $clientEmail }}
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td style="color: #666; font-size: 14px;">
                          <strong>Téléphone :</strong>
                        </td>
                        <td style="color: #333; font-size: 14px;">
                          {{ $clientPhone }}
                        </td>
                      </tr>
                      <tr>
                        <td style="color: #666; font-size: 14px;">
                          <strong>Date :</strong>
                        </td>
                        <td style="color: #666; font-size: 13px;">
                          {{ $requestDate }}
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Message du client -->
          <tr>
            <td style="padding: 25px 30px;">
              <div style="background-color: #fff; border-left: 4px solid #ff6b35; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <h3 style="margin: 0 0 15px 0; color: #333; font-size: 16px; font-weight: 700;">
                  💬 Message du client :
                </h3>
                <p style="margin: 0; color: #555; font-size: 15px; line-height: 1.7; font-style: italic;">
                  "{{ $clientMessage }}"
                </p>
              </div>
            </td>
          </tr>

          <!-- Boutons d'action -->
          <tr>
            <td style="padding: 30px; text-align: center;">
              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="center" style="padding-bottom: 15px;">
                    <a href="mailto:{{ $clientEmail }}"
                       style="display: inline-block; background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%); color: #ffffff; text-decoration: none; padding: 16px 40px; border-radius: 50px; font-weight: 700; font-size: 16px; box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);">
                      📧 Répondre au client
                    </a>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    <a href="{{ $propertyUrl }}"
                       style="display: inline-block; background-color: #f8f9fa; color: #333; text-decoration: none; padding: 14px 35px; border-radius: 50px; font-weight: 600; font-size: 14px; border: 2px solid #dee2e6;">
                      🏠 Voir la propriété
                    </a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Conseils -->
          <tr>
            <td style="padding: 0 30px 30px 30px;">
              <div style="background-color: #e7f3ff; border-radius: 12px; padding: 20px; border-left: 4px solid #007bff;">
                <h4 style="margin: 0 0 10px 0; color: #0056b3; font-size: 15px; font-weight: 700;">
                  💡 Conseils pour une réponse efficace :
                </h4>
                <ul style="margin: 0; padding-left: 20px; color: #004085; font-size: 14px; line-height: 1.8;">
                  <li>Répondez dans les <strong>24 heures</strong> pour maximiser vos chances</li>
                  <li>Personnalisez votre réponse en fonction du message du client</li>
                  <li>Proposez une visite ou un rendez-vous téléphonique</li>
                  <li>Soyez professionnel et courtois dans votre communication</li>
                </ul>
              </div>
            </td>
          </tr>

          <!-- Séparateur -->
          <tr>
            <td style="padding: 0 30px;">
              <hr style="border: none; border-top: 1px solid #e9ecef; margin: 20px 0;">
            </td>
          </tr>

          <!-- Statistiques rapides (optionnel) -->
          <tr>
            <td style="padding: 20px 30px;">
              <table width="100%" cellpadding="15" cellspacing="0">
                <tr>
                  <td align="center" style="background-color: #f8f9fa; border-radius: 10px; width: 33.33%;">
                    <div style="font-size: 24px; font-weight: 700; color: #ff6b35;">⚡</div>
                    <div style="font-size: 12px; color: #666; margin-top: 5px;">Réponse rapide</div>
                  </td>
                  <td width="10"></td>
                  <td align="center" style="background-color: #f8f9fa; border-radius: 10px; width: 33.33%;">
                    <div style="font-size: 24px; font-weight: 700; color: #28a745;">🤝</div>
                    <div style="font-size: 12px; color: #666; margin-top: 5px;">Professionnalisme</div>
                  </td>
                  <td width="10"></td>
                  <td align="center" style="background-color: #f8f9fa; border-radius: 10px; width: 33.33%;">
                    <div style="font-size: 24px; font-weight: 700; color: #007bff;">📈</div>
                    <div style="font-size: 12px; color: #666; margin-top: 5px;">Plus de ventes</div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="background-color: #2c3e50; padding: 30px; text-align: center;">
              <p style="margin: 0 0 10px 0; color: #ecf0f1; font-size: 16px; font-weight: 600;">
                EMMO - Plateforme Immobilière
              </p>
              <p style="margin: 0 0 20px 0; color: #95a5a6; font-size: 13px;">
                Connectons les rêves avec les propriétés
              </p>
              {{-- <div style="margin-bottom: 20px;">
                <a href="#" style="display: inline-block; margin: 0 8px; color: #3498db; text-decoration: none; font-size: 20px;">📘</a>
                <a href="#" style="display: inline-block; margin: 0 8px; color: #1da1f2; text-decoration: none; font-size: 20px;">🐦</a>
                <a href="#" style="display: inline-block; margin: 0 8px; color: #25d366; text-decoration: none; font-size: 20px;">💬</a>
              </div> --}}
              <p style="margin: 0; color: #95a5a6; font-size: 12px; line-height: 1.6;">
                Cet email a été envoyé automatiquement. Veuillez ne pas y répondre directement.<br>
                Pour toute question, contactez-nous à <a href="mailto:emmotsoa261@gmail.com" style="color: #3498db; text-decoration: none;">emmotsoa261@gmail.com</a>
              </p>
              <p style="margin: 15px 0 0 0; color: #7f8c8d; font-size: 11px;">
                © 2025 E-MMO. Tous droits réservés.
              </p>
            </td>
          </tr>

        </table>

        <!-- Message en bas de page -->
        <table width="600" cellpadding="0" cellspacing="0" style="margin-top: 20px;">
          <tr>
            <td align="center">
              <p style="margin: 0; color: #95a5a6; font-size: 11px; line-height: 1.5;">
                Vous recevez cet email car un client a manifesté son intérêt pour l'une de vos propriétés sur EMMO.<br>
                Si vous ne souhaitez plus recevoir ces notifications, veuillez nous contacter.
              </p>
            </td>
          </tr>
        </table>

      </td>
    </tr>
  </table>
</body>
</html>
