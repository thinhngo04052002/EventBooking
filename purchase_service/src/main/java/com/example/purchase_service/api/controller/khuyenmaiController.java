package com.example.purchase_service.api.controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.example.purchase_service.api.dto.addKhuyenmaiDto;
import com.example.purchase_service.api.model.khuyenmai;
import com.example.purchase_service.api.service.khuyenmaiService;

@RestController
@RequestMapping("/khuyenmai")
public class khuyenmaiController {
    private khuyenmaiService khuyenmaiService;

    @Autowired
    public void setKhuyenmaiService(khuyenmaiService khuyenmaiService) {
        this.khuyenmaiService = khuyenmaiService;
    }

    @GetMapping("/khuyenmai")
    public List<khuyenmai> listAll() {
        return khuyenmaiService.getAllKhuyenMai();
    }

    @GetMapping("/{id}")
    public ResponseEntity<?> getkhuyenmai(@PathVariable int id) {
        khuyenmai khuyenmai = khuyenmaiService.getKhuyenMaiById(id);
        if (khuyenmai == null) {
            return ResponseEntity.badRequest().body("Không tồn tại khuyenmai.");
        }
        return ResponseEntity.ok(khuyenmai);
    }

    @GetMapping("/GetByIDSukien")
    public List<khuyenmai> GetByIDSukien(int IDSuKien) {
        return khuyenmaiService.getKhuyenMaiByIdSuKien(IDSuKien);
    }

    @PostMapping("/khuyenmai")
    public ResponseEntity<?> createKhuyenmai(@RequestBody addKhuyenmaiDto dto) {
        try {
            khuyenmai newKhuyenmai = khuyenmaiService.createKhuyenmai(dto);
            return ResponseEntity.status(HttpStatus.CREATED).body(newKhuyenmai);
        } catch (Exception e) {
            return ResponseEntity.badRequest().body("Không thể tạo mã khuyến mãi: " + e.getMessage());
        }
    }

    @PutMapping("/{id}")
    public ResponseEntity<?> updateKhuyenmai(@PathVariable("id") int id, @RequestBody addKhuyenmaiDto dto) {
        try {
            khuyenmai updatedKhuyenmai = khuyenmaiService.updateKhuyenmai(id, dto);
            if (updatedKhuyenmai == null)
                return ResponseEntity.badRequest().body("Không tồn tại mã khuyến mãi có ID: " + id);
            else
                return ResponseEntity.ok(updatedKhuyenmai);
        } catch (Exception e) {
            return ResponseEntity.badRequest().body("Không thể cập nhật mã khuyến mãi: " + e.getMessage());
        }
    }

    @PutMapping("/UpdateIDSuKien/{id}/{IDSuKien}")
    public ResponseEntity<?> UpdateIDSuKien(@PathVariable("id") int id, @PathVariable("IDSuKien") int IDSuKien) {
        try {
            khuyenmai updatedKhuyenmai = khuyenmaiService.UpdateIDSuKien(id, IDSuKien);
            if (updatedKhuyenmai == null)
                return ResponseEntity.badRequest().body("Không tồn tại mã khuyến mãi có ID: " + id);
            else
                return ResponseEntity.ok(updatedKhuyenmai);
        } catch (Exception e) {
            return ResponseEntity.badRequest().body("Không thể cập nhật mã khuyến mãi: " + e.getMessage());
        }
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<?> deleteKhuyenmai(@PathVariable("id") int id) {
        boolean deleted = khuyenmaiService.deleteKhuyenmai(id);
        if (deleted) {
            return ResponseEntity.ok("Xóa mã khuyến mãi thành công");
        } else {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body("Không tìm thấy mã khuyến mãi với ID: " + id);
        }
    }
}