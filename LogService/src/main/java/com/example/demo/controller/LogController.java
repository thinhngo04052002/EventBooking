package com.example.demo.controller;

import java.net.DatagramSocket;
import java.net.InetAddress;
import java.time.Duration;
import java.time.Instant;
import java.util.ArrayList;
import java.util.List;

import org.bson.types.ObjectId;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
// import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.example.demo.dto.AddLogDoiVeHoanTienDto;
import com.example.demo.dto.AddLogDoiVeThanhToanThemDto;
import com.example.demo.dto.AddLogHuyVeDto;
import com.example.demo.dto.AddLogMuaVeDto;
import com.example.demo.model.Log;
import com.example.demo.repository.LogRepository;

import jakarta.servlet.http.HttpServletRequest;

@RestController
@RequestMapping("/Log")
public class LogController {
    @Autowired
    private LogRepository repo;

    @GetMapping("/getAll")
    public ResponseEntity<List<Log>> getAllLog() {
        try {
            List<Log> Loglist = new ArrayList<Log>();
            repo.findAll().forEach(Loglist::add);
            if (Loglist.isEmpty()) {
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(Loglist, HttpStatus.OK);
        } catch (Exception e) {
            List<Log> Loglist = new ArrayList<Log>();
            return new ResponseEntity<>(Loglist, HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    // @PostMapping("/add")
    // public ResponseEntity<Log> AddLog(@RequestBody Log Log,
    // HttpServletRequest request) {
    // try {
    // // Tạo _id
    // ObjectId objectId = new ObjectId();
    // String _id = objectId.toHexString();
    // // Lấy địa chỉ IP của thiết bị
    // String ipAddress = "";
    // try (final DatagramSocket socket = new DatagramSocket()) {
    // socket.connect(InetAddress.getByName("8.8.8.8"), 10002);
    // ipAddress = socket.getLocalAddress().getHostAddress();
    // }
    // Log _Log = repo.save(new Log(_id, Log.getTenHanhDong(),
    // Instant.now().plus(Duration.ofHours(7)), Log.getMoTa(), ipAddress));
    // return new ResponseEntity<>(_Log, HttpStatus.CREATED);
    // } catch (Exception e) {
    // return new ResponseEntity<>(Log, HttpStatus.INTERNAL_SERVER_ERROR);
    // }
    // }

    @PostMapping("/addLogMuaVe")
    public ResponseEntity<Log> AddLogMuaVe(@RequestBody AddLogMuaVeDto dto, HttpServletRequest request) {
        try {
            Log _Log = new Log();
            // Tạo _id
            ObjectId objectId = new ObjectId();
            String _id = objectId.toHexString();
            // Tạo mô tả
            String moTa = "Khách hàng có id " + dto.getIdKhachHang() + " đã mua vé [";
            List<Integer> DanhSachVe = dto.getDanhSachVe();
            for (int i = 0; i < DanhSachVe.size() - 1; i++)
                moTa = moTa + DanhSachVe.get(i).toString() + ",";
            moTa = moTa + DanhSachVe.get(DanhSachVe.size() - 1) + "] với tổng tiền là " + dto.getTongTien();
            // Lấy địa chỉ IP của thiết bị
            String ipAddress = "";
            try (final DatagramSocket socket = new DatagramSocket()) {
                socket.connect(InetAddress.getByName("8.8.8.8"), 10002);
                ipAddress = socket.getLocalAddress().getHostAddress();
            }
            // Lưu dữ liệu vào database
            _Log = repo.save(new Log(_id, "Mua vé",
                    Instant.now().plus(Duration.ofHours(7)), moTa, ipAddress));
            return new ResponseEntity<>(_Log, HttpStatus.CREATED);
        } catch (Exception e) {
            Log _Log = new Log();
            return new ResponseEntity<>(_Log, HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @PostMapping("/addLogDoiVeThanhToanThem")
    public ResponseEntity<Log> AddLogDoiVeThanhToanThem(@RequestBody AddLogDoiVeThanhToanThemDto dto,
            HttpServletRequest request) {
        try {
            Log _Log = new Log();
            // Tạo _id
            ObjectId objectId = new ObjectId();
            String _id = objectId.toHexString();
            // Tạo mô tả
            String moTa = "Khách hàng có id " + dto.getIdKhachHang() + " đã đổi vé [" + dto.getIdVeCu() + "] sang vé ["
                    + dto.getIdVeMoi() + "] với tổng tiền thanh toán thêm là " + dto.getSoTienThanhToanThem();
            // Lấy địa chỉ IP của thiết bị
            String ipAddress = "";
            try (final DatagramSocket socket = new DatagramSocket()) {
                socket.connect(InetAddress.getByName("8.8.8.8"), 10002);
                ipAddress = socket.getLocalAddress().getHostAddress();
            }
            // Lưu dữ liệu vào database
            _Log = repo.save(new Log(_id, "Đổi vé thanh toán thêm",
                    Instant.now().plus(Duration.ofHours(7)), moTa, ipAddress));
            return new ResponseEntity<>(_Log, HttpStatus.CREATED);
        } catch (Exception e) {
            Log _Log = new Log();
            return new ResponseEntity<>(_Log, HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @PostMapping("/addLogDoiVeHoanTien")
    public ResponseEntity<Log> AddLogDoiVeHoanTien(@RequestBody AddLogDoiVeHoanTienDto dto,
            HttpServletRequest request) {
        try {
            Log _Log = new Log();
            // Tạo _id
            ObjectId objectId = new ObjectId();
            String _id = objectId.toHexString();
            // Tạo mô tả
            String moTa = "Khách hàng có id " + dto.getIdKhachHang() + " đã đổi vé [" + dto.getIdVeCu() + "] sang vé ["
                    + dto.getIdVeMoi() + "], tổng tiền hoàn lại là " + dto.getSoTienHoan();
            // Lấy địa chỉ IP của thiết bị
            String ipAddress = "";
            try (final DatagramSocket socket = new DatagramSocket()) {
                socket.connect(InetAddress.getByName("8.8.8.8"), 10002);
                ipAddress = socket.getLocalAddress().getHostAddress();
            }
            // Lưu dữ liệu vào database
            _Log = repo.save(new Log(_id, "Đổi vé thanh toán thêm",
                    Instant.now().plus(Duration.ofHours(7)), moTa, ipAddress));
            return new ResponseEntity<>(_Log, HttpStatus.CREATED);
        } catch (Exception e) {
            Log _Log = new Log();
            return new ResponseEntity<>(_Log, HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @PostMapping("/addLogHuyVe")
    public ResponseEntity<Log> AddLogHuyVe(@RequestBody AddLogHuyVeDto dto,
            HttpServletRequest request) {
        try {
            Log _Log = new Log();
            // Tạo _id
            ObjectId objectId = new ObjectId();
            String _id = objectId.toHexString();
            // Tạo mô tả
            String moTa = "Khách hàng có id " + dto.getIdKhachHang() + " đã hủy vé [" + dto.getIdVe()
                    + "], tổng tiền hoàn lại là " + dto.getSoTienHoan();
            // Lấy địa chỉ IP của thiết bị
            String ipAddress = "";
            try (final DatagramSocket socket = new DatagramSocket()) {
                socket.connect(InetAddress.getByName("8.8.8.8"), 10002);
                ipAddress = socket.getLocalAddress().getHostAddress();
            }
            // Lưu dữ liệu vào database
            _Log = repo.save(new Log(_id, "Đổi vé thanh toán thêm",
                    Instant.now().plus(Duration.ofHours(7)), moTa, ipAddress));
            return new ResponseEntity<>(_Log, HttpStatus.CREATED);
        } catch (Exception e) {
            Log _Log = new Log();
            return new ResponseEntity<>(_Log, HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

}
