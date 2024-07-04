package com.example.purchase_service.api.repository;

// import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.example.purchase_service.api.model.hoadon;

@Repository
public interface hoadonRepository extends JpaRepository<hoadon, Integer> {
    hoadon findById(int id);

    hoadon findByIDTaiKhoanAndIDVe(int IDTaiKhoan, int IDVe);
}
