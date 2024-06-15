package com.example.demo.repository;

import org.springframework.data.mongodb.repository.MongoRepository;

import com.example.demo.model.Logging;

public interface LoggingRepository extends MongoRepository<Logging, String> {
    // CRUD
}
