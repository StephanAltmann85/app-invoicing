Feature: Login

    Scenario: As a user I should not be able to access the admin area when not logged in
        When I request page "/admin"
        Then I should get redirected to "/"
