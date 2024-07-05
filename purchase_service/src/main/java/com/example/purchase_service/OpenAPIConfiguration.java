package com.example.purchase_service;

import java.util.List;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;

import io.swagger.v3.oas.models.OpenAPI;
import io.swagger.v3.oas.models.info.Contact;
import io.swagger.v3.oas.models.info.Info;
import io.swagger.v3.oas.models.servers.Server;

@Configuration
public class OpenAPIConfiguration {

    @Bean
    public OpenAPI defineOpenApi() {
        Server server = new Server();
        server.setUrl("http://localhost:8002");
        server.setDescription("Development");

        Contact myContact = new Contact();
        myContact.setName("Group UDPT 08");
        myContact.setEmail("just an email");

        Info information = new Info()
                .title("PURCHASE SERVICE API")
                .version("1.0")
                .description("This API exposes endpoints to manage purchase.")
                .contact(myContact);
        return new OpenAPI().info(information).servers(List.of(server));
    }
}