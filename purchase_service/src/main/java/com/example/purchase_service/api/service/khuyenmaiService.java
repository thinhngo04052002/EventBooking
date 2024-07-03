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

    public khuyenmai getKhuyenMaiByMakhuyenmai(String makhuyenmai) {
        return repo.findByMakhuyenmai(makhuyenmai);
    }

    public khuyenmai getKhuyenMaiByMakhuyenmai(String makhuyenmai) {
        return repo.findByMakhuyenmai(makhuyenmai);
    }

    public List<khuyenmai> getKhuyenMaiByIdSuKienIdDoiTac(int IDSuKien, int IDDoiTac) {
        return repo.findByIdsukienAndIddoitac(IDSuKien, IDDoiTac);
    }

    public khuyenmai createKhuyenmai(addKhuyenmaiDto dto) {
        // Tạo một đối tượng khuyenmai mới
        khuyenmai khuyenmai = new khuyenmai();
        khuyenmai.setIdsukien(dto.getIdsukien());
        khuyenmai.setIddoitac(dto.getIddoitac());
        khuyenmai.setChietkhau(dto.getChietkhau());
        khuyenmai.setMakhuyenmai(dto.getMakhuyenmai());
        // Lưu sản phẩm mới vào cơ sở dữ liệu
        return repo.save(khuyenmai);
    }

    public khuyenmai updateKhuyenmai(int id, addKhuyenmaiDto dto) {
        khuyenmai updateKhuyenmai = repo.findById(id);
        if (updateKhuyenmai != null) {
            updateKhuyenmai.setIdsukien(dto.getIdsukien());
            updateKhuyenmai.setIddoitac(dto.getIddoitac());
            updateKhuyenmai.setChietkhau(dto.getChietkhau());
            updateKhuyenmai.setMakhuyenmai(dto.getMakhuyenmai());
            return repo.save(updateKhuyenmai);
        } else {
            return null;
        }
    }

    public khuyenmai UpdateIDSuKien(int id, int IDSuKien) {
        khuyenmai updateKhuyenmai = repo.findById(id);
        if (updateKhuyenmai != null) {
            updateKhuyenmai.setIdsukien(IDSuKien);
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
