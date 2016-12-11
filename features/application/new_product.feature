  Feature: Adding new product to list

    @application
    Scenario: Filling the form and sending email
      Given I am authenticated as "user"
      And I am on "/admin/new-product"
      When I fill in the following:
        | appbundle_product[name]        | Some name |
        | appbundle_product[description] | Description that contains at least hundred signs. Description that contains at least hundred signs. Desc |
        | appbundle_product[price]       | 100 |
      And I press "Dodaj"
      Then the response status code should be 200
      And message should be put on a queue
