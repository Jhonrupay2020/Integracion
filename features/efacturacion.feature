Feature: Factura Costo de Servicio
  Para suscribirte a nuestro servicio
  Como cliente
  Yo necesito obtener ofertas para adquirir el servicio

  Reglas:
  - IGV es 18%
  - Si paga por nuestro servicio con un costo menor de 100$ sera descontado $5
  - Si paga por nuestro servicio con un costo mayor de 100$ sera descontado $10




  Scenario: Adquirir el servicio con costo menor de $100
    Given there is a "Servicio ", which costs $50
    When I add the "Servicio " to the basket
    Then I should have 1 service in the basket
    And the overall basket price should be $55


  Scenario: Adquirir el servicio con costo mayor de $100
    Given there is a "Servicio Premium", which costs $200
    When I add the "Servicio Premium" to the basket
    Then I should have 1 service in the basket
    And the overall basket price should be $226



  Scenario: Adquiriendo los 2 servicios con costo mayor de $100
    Given there is a "Servicio Normal", which costs $50
    And there is a "Servicio Premium", which costs $200
    When I add the "Servicio Normal" to the basket
    And I add the "Servicio Premium" to the basket
    Then I should have 2 services in the basket
    And the overall basket price should be $285


    Scenario: Debería haber un enlace en la página de inicio de sesión contraseña olvidada
  Given  I am on login "/login"
  Then I should see the text "¿Olvidó su contraseña?"



  Scenario: Debe estar registrado su suscripcion para que pueda realizar transacciones en el sistema
  Given  I am on suscripcion "/suscripcion"
  Then I should see the text2 "Suscripcion Activa"

