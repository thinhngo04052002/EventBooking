package ProductApplication.controller;


import java.util.List;


import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.bind.annotation.RequestBody;

import ProductApplication.DTO.DanhSachVeDaMuaDTO;
import ProductApplication.DTO.LoaiVeDTO;
import ProductApplication.DTO.SuatDienDTO;
import ProductApplication.DTO.VeDaMuaDTO;
import ProductApplication.service.VeDaMuaService;

@SpringBootApplication
@RestController
@RequestMapping("/api/product/vedamua")

public class VeDaMuaController {

    @Autowired
    private VeDaMuaService veDaMuaService;

    @GetMapping("/getAllVeDaMuaByIdNguoiDung/{IDNguoiDung}")
    public ResponseEntity<VeDaMuaDTO> getAllVeDaMuaByIdNguoiDung(@PathVariable Integer IDNguoiDung) {
    	if(IDNguoiDung==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        
        try {
        	VeDaMuaDTO all = veDaMuaService.getAllVeDaMuaByIdNguoiDung(IDNguoiDung);
            if (all==null) {
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(all, HttpStatus.OK);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    
    @PutMapping("/putAddVeDaMua")
    public ResponseEntity<Integer> createVeDaMua(
    		@RequestParam Integer idNguoiDung,
    		@RequestParam Integer idVe,
    		@RequestParam Integer idSuKien,
    		@RequestParam Integer idDoiTac
    		) {
    	if(idNguoiDung==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(idVe==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(idSuKien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(idDoiTac==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
        	Integer result = veDaMuaService.createVeDaMua(idNguoiDung,idVe,idSuKien,idDoiTac);
        	if (result==1) {
            	return new ResponseEntity<>(result, HttpStatus.CREATED);
        	} else if(result==2) {
        		return new ResponseEntity<>(result, HttpStatus.CONFLICT);
        	}
        	
            return new ResponseEntity<>(result,HttpStatus.INTERNAL_SERVER_ERROR);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @PutMapping("/putUpdateVeDaMua")
    public ResponseEntity<Integer> updateVeDaMua(
    		@RequestParam Integer idNguoiDung,
    		@RequestParam Integer idVe,
    		@RequestParam Integer idSuKien,
    		@RequestParam Integer idVeCu,
    		@RequestParam Integer idDoiTac) {
    	if(idNguoiDung==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(idVe==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(idSuKien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(idDoiTac==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
        	Integer result = veDaMuaService.updateVeDaMua(idNguoiDung,idVe,idSuKien,idDoiTac,idVeCu);
        	if (result==1) {
            	return new ResponseEntity<>(result, HttpStatus.CREATED);
        	} else if(result==2) {
        		return new ResponseEntity<>(result, HttpStatus.CONFLICT);
        	}
        	
            return new ResponseEntity<>(result,HttpStatus.INTERNAL_SERVER_ERROR);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
}