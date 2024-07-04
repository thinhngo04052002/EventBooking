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

import com.example.purchase_service.api.dto.HuyHoaDonDto;
import com.example.purchase_service.api.dto.addHoaDonDoiVeDto;
import com.example.purchase_service.api.dto.addHoaDonMuaVeDto;
import com.example.purchase_service.api.dto.addHoadonDto;
import com.example.purchase_service.api.dto.goiAPIThanhToanDto;
import com.example.purchase_service.api.model.hoadon;
import com.example.purchase_service.api.service.hoadonService;

@RestController
@RequestMapping("/hoadon")
public class hoadonController {
    private hoadonService hoadonService;

    @Autowired
    public void sethoadonService(hoadonService hoadonService) {
        this.hoadonService = hoadonService;
    }

    @GetMapping("/hoadon")
    public List<hoadon> listAll() {
        return hoadonService.getAllhoadon();
    }

    @GetMapping("/{id}")
    public ResponseEntity<?> gethoadon(@PathVariable int id) {
        hoadon hoadon = hoadonService.gethoadonById(id);
        if (hoadon == null) {
            return ResponseEntity.badRequest().body("Không tồn tại hoadon.");
        }
        return ResponseEntity.ok(hoadon);
    }

    @PostMapping("/hoadon")
    public ResponseEntity<?> createhoadon(@RequestBody addHoadonDto dto) {
        try {
            hoadon newhoadon = hoadonService.createhoadon(dto);
            return ResponseEntity.status(HttpStatus.CREATED).body(newhoadon);
        } catch (Exception e) {
            return ResponseEntity.badRequest().body("Không thể tạo hóa đơn: " + e.getMessage());
        }
    }

    @PostMapping("/goiAPIThanhToan")
    public ResponseEntity<?> GoiAPIThanhToan(@RequestBody goiAPIThanhToanDto dto) {
        try {
            hoadonService.GoiAPIThanhToan(dto);
            return ResponseEntity.status(HttpStatus.CREATED).body(null);
        } catch (Exception e) {
            return ResponseEntity.badRequest().body("Không thể tạo hóa đơn: " + e.getMessage());
        }
    }

    @PostMapping("/CreateHoaDonMuaVe")
    public ResponseEntity<?> CreateHoaDonMuaVe(@RequestBody addHoaDonMuaVeDto dto) {
        try {
            hoadon newhoadon = hoadonService.CreateHoaDonMuaVe(dto);
            return ResponseEntity.status(HttpStatus.CREATED).body(newhoadon);
        } catch (Exception e) {
            return ResponseEntity.badRequest().body("Không thể tạo hóa đơn: " + e.getMessage());
        }
    }

    @PostMapping("/CreateHoaDonDoiVe")
    public ResponseEntity<?> CreateHoaDonDoiVe(@RequestBody addHoaDonDoiVeDto dto) {
        try {
            hoadon newhoadon = hoadonService.CreateHoaDonDoiVe(dto);
            return ResponseEntity.status(HttpStatus.CREATED).body(newhoadon);
        } catch (Exception e) {
            return ResponseEntity.badRequest().body("Không thể tạo hóa đơn: " + e.getMessage());
        }
    }

    @PutMapping("/{id}")
    public ResponseEntity<?> updatehoadon(@PathVariable("id") int id, @RequestBody addHoadonDto dto) {
        try {
            hoadon updatedhoadon = hoadonService.updatehoadon(id, dto);
            if (updatedhoadon == null)
                return ResponseEntity.badRequest().body("Không tồn tại hóa đơn có ID: " + id);
            else
                return ResponseEntity.ok(updatedhoadon);
        } catch (Exception e) {
            return ResponseEntity.badRequest().body("Không thể cập nhật hóa đơn: " + e.getMessage());
        }
    }

    @PutMapping("/HuyHoaDon")
    public ResponseEntity<?> HuyHoaDon(@RequestBody HuyHoaDonDto dto) {
        try {
            hoadon updatedhoadon = hoadonService.HuyHoaDon(dto);
            if (updatedhoadon == null)
                return ResponseEntity.badRequest().body("Không tìm thấy hóa đơn");
            else
                return ResponseEntity.ok(updatedhoadon);
        } catch (Exception e) {
            return ResponseEntity.badRequest().body("Không thể cập nhật hóa đơn: " + e.getMessage());
        }
    }

    @DeleteMapping("/{id_hoadon}")
    public ResponseEntity<?> deletehoadon(@PathVariable("id_hoadon") int id_hoadon) {
        boolean deleted = hoadonService.deletehoadon(id_hoadon);
        if (deleted) {
            return ResponseEntity.ok("Xóa hóa đơn thành công");
        } else {
            return ResponseEntity.status(HttpStatus.NOT_FOUND)
                    .body("Không tìm thấy hóa đơn với ID: " + id_hoadon);
        }
    }
}