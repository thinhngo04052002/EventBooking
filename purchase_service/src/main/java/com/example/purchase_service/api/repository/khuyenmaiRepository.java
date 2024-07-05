package com.example.purchase_service.api.repository;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.example.purchase_service.api.model.khuyenmai;

@Repository
public interface khuyenmaiRepository extends JpaRepository<khuyenmai, Integer> {
    List<khuyenmai> findByIdsukienAndIddoitac(int idsukien, int iddoitac);

    List<khuyenmai> findByIdsukienIsNullAndIddoitac(Integer idDoiTac);

    khuyenmai findById(int id);

    khuyenmai findByMakhuyenmai(String makhuyenmai);

}
