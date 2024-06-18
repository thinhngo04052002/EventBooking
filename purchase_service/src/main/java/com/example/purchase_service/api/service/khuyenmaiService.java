package com.example.purchase_service.api.service;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.purchase_service.api.dto.addKhuyenmaiDto;
import com.example.purchase_service.api.model.khuyenmai;
import com.example.purchase_service.api.repository.khuyenmaiRepository;

@Service
public class khuyenmaiService {
    @Autowired
    private khuyenmaiRepository repo;

    public List<khuyenmai> getAllKhuyenMai() {
        return repo.findAll();
    }

    public khuyenmai getKhuyenMaiById(int id) {
        return repo.findById(id);
    }

    public khuyenmai createKhuyenmai(addKhuyenmaiDto dto) {
        // Tạo một đối tượng khuyenmai mới
        khuyenmai khuyenmai = new khuyenmai();
        khuyenmai.setIdsukien(dto.getIdsukien());
        khuyenmai.setChietkhau(dto.getChietkhau());
        khuyenmai.setMakhuyenmai(dto.getMakhuyenmai());
        // Lưu sản phẩm mới vào cơ sở dữ liệu
        return repo.save(khuyenmai);
    }

    public khuyenmai updateKhuyenmai(int id, addKhuyenmaiDto dto) {
        khuyenmai updateKhuyenmai = repo.findById(id);
        if (updateKhuyenmai != null) {
            updateKhuyenmai.setIdsukien(dto.getIdsukien());
            updateKhuyenmai.setChietkhau(dto.getChietkhau());
            updateKhuyenmai.setMakhuyenmai(dto.getMakhuyenmai());
            return repo.save(updateKhuyenmai);
        } else {
            return null;
        }
    }

    public boolean deleteKhuyenmai(int id) {
        if (repo.existsById(id)) {
            repo.deleteById(id);
            return true;
        } else {
            return false;
        }
    }

}
