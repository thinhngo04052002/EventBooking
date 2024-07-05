package ProductApplication.controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.bind.annotation.RequestBody;
import ProductApplication.DTO.VeDTO;
import ProductApplication.service.VeService;
@SpringBootApplication
@RestController
@RequestMapping("/product/ve")
public class VeController {
    @Autowired
    private VeService veService;

    @GetMapping("/getAllVe")
    public ResponseEntity<List<VeDTO>> getAllVe() {       
        try {
            List<VeDTO> veList = veService.getAllVe();
            if (veList==null) {
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(veList, HttpStatus.OK);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    	
    }

//    @GetMapping("/getVeByIDVe/{IDVe}")
//    public ResponseEntity<VeDTO> getVeById(@PathVariable Integer IDVe) {
//        	try {
//                VeDTO ve = veService.getVeByIDVe(IDVe);
//                if (ve!=null) {
//                	return new ResponseEntity<>(ve, HttpStatus.OK);
//                    
//                }
//                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
//            } catch (Exception e) {
//                return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
//            }
//    }
    
    @GetMapping("/getVeByIdVe-IDSuKien-IDDoiTac")
    public ResponseEntity<VeDTO> getVeByIdVeAndIDSuKien(
    	@RequestParam Integer iDVe,
        @RequestParam Integer iDSuKien,
        @RequestParam Integer iDDoiTac
        
    ) {
    	if(iDVe==null||iDSuKien==null ) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	try {
            VeDTO ve = veService.getVeByIdVeAndIDSuKienAndIDDoiTac(iDVe, iDSuKien,iDDoiTac);
            if (ve!=null) {
            	return new ResponseEntity<>(ve, HttpStatus.OK);
                
            }
            return new ResponseEntity<>(HttpStatus.NO_CONTENT);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    
    
    
    @GetMapping("/getVeByIdSuKien-IdSuatDien-IdDoiTac")
    public ResponseEntity<List<VeDTO>> getVeByIdSuKienAndIdSuatDienAndIdDoiTac(
    		@RequestParam Integer iDSuKien,
            @RequestParam Integer iDSuatDien,
            @RequestParam Integer iDDoiTac) {
    	if(iDSuKien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(iDSuatDien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	if(iDDoiTac==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
        	List<VeDTO> veList = veService.getVeByIdSuKienAndIdSuatDienAndIdDoiTac(iDSuKien,iDSuatDien,iDDoiTac);
            if (veList==null) {
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(veList, HttpStatus.OK);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @GetMapping("/getMotVeChuaBan")
    public ResponseEntity<VeDTO> getMotVeChuaBan(
        @RequestParam Integer iDLoaiVe,
        @RequestParam Integer iDSuKien,
        @RequestParam Integer iDSuatDien,
        @RequestParam Integer iDDoiTac
    ) {
    	if(iDLoaiVe==null||iDSuKien==null||iDSuatDien==null||iDDoiTac==null ) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
        	String trangThaiBan="Chưa bán";
        	VeDTO ve = veService.getMotVeChuaBan(iDLoaiVe, iDSuKien,iDSuatDien,iDDoiTac, trangThaiBan);
            if (ve!=null) {
            	return new ResponseEntity<>(ve, HttpStatus.OK);
                
            }
            return new ResponseEntity<>(HttpStatus.NO_CONTENT);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @GetMapping("/getVeByIdSuKien-IdSuatDien-IdDoiTac-TrangThaiBan")
    public ResponseEntity<List<VeDTO>> getVeByIdSuKienAndIdSuatDienAndIdDoiTacAndTrangThaiBan(
        @RequestParam Integer iDSuKien,
        @RequestParam Integer iDSuatDien,
        @RequestParam Integer iDDoiTac,
        @RequestParam String trangThaiBan
    ) {
    	if(iDSuKien==null ||trangThaiBan==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	try {
    		List<VeDTO> veList = veService.getVeByIdSuKienAndIdSuatDienAndIdDoiTacAndTrangThaiBan(iDSuKien,iDSuatDien,iDDoiTac, trangThaiBan);
            if (veList==null) {
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(veList, HttpStatus.OK);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    
    @GetMapping("/getVeByIdSuKien-IdSuatDien-IdDoiTac-TrangThaiDung")
    public ResponseEntity<List<VeDTO>> getVeByIdSuKienAndIdSuatDienAndIdDoiTacAndTrangThaiDung(
        @RequestParam Integer iDSuKien,
        @RequestParam Integer iDSuatDien,
        @RequestParam Integer iDDoiTac,
        @RequestParam String trangThaiDung
    ) {
    	if(iDSuKien==null ||trangThaiDung==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	try {
    		List<VeDTO> veList = veService.getVeByIdSuKienAndIdSuatDienAndIdDoiTacAndTrangThaiDung(iDSuKien,iDSuatDien,iDDoiTac, trangThaiDung);
            if (veList==null) {
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(veList, HttpStatus.OK);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    
    @GetMapping("/getVeByIdLoaiVe-IdSuKien-IdSuatDien-IdDoiTac-TrangThaiBan")
    public ResponseEntity<List<VeDTO>> getVeByIdLoaiVeAndIdSuKienAndTrangThaiBan(
        @RequestParam Integer iDLoaiVe,
        @RequestParam Integer iDSuKien,
        @RequestParam Integer iDSuatDien,
        @RequestParam Integer iDDoiTac,
        @RequestParam String trangThaiBan
    ) {
    	if(iDLoaiVe==null||iDSuKien==null ||trangThaiBan==null||iDSuatDien==null ||iDDoiTac==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	try {
    		List<VeDTO> veList = veService.getVeByIdLoaiVeAndIdSuKienAndIDSuatDienAndIDDoiTacAndTrangThaiBan(iDLoaiVe, iDSuKien,iDSuatDien,iDDoiTac, trangThaiBan);
            if (veList==null) {
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(veList, HttpStatus.OK);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    
    @GetMapping("/getVeByIdLoaiVe-IdSuKien-IdSuatDien-IdDoiTac")
    public ResponseEntity<List<VeDTO>> getVeByIdLoaiVeAndIdSuKienAndIdSuatDienAndIdDoiTac(
        @RequestParam Integer iDLoaiVe,
        @RequestParam Integer iDSuKien,
        @RequestParam Integer iDSuatDien,
        @RequestParam Integer iDDoiTac
    ) {
    	if(iDLoaiVe==null||iDSuKien==null ||iDSuatDien==null ||iDDoiTac==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	try {
    		List<VeDTO> veList = veService.getVeByIdLoaiVeAndIdSuKienAndIdSuatDienAndIdDoiTac(iDLoaiVe, iDSuKien, iDSuatDien,iDDoiTac);
            if (veList==null) {
                return new ResponseEntity<>(HttpStatus.NO_CONTENT);
            }
            return new ResponseEntity<>(veList, HttpStatus.OK);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    @PutMapping("/putUpdateTinhTrangVe")
    public ResponseEntity<Integer> putUpdateTinhTrangVe(
    		@RequestParam Integer iDVe,
            @RequestParam Integer iDSuKien,
            @RequestParam Integer iDDoiTac,
            @RequestParam String trangThaiBan
        ) {
    	if(iDVe==null ||iDSuKien==null||iDDoiTac==null ||trangThaiBan==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
            Integer result = veService.updateTinhTrangVe(iDVe,iDSuKien,iDDoiTac,trangThaiBan);
            if (result==1) {
            	return new ResponseEntity<>(result, HttpStatus.OK);
            } else if(result==0) {
            	return new ResponseEntity<>(result,HttpStatus.NOT_FOUND);
            }
            return new ResponseEntity<>(result,HttpStatus.INTERNAL_SERVER_ERROR);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    
    @PutMapping("/putUpdateTrangThaiDung")
    public ResponseEntity<Integer> putUpdateTrangThaiDung(
    		@RequestParam Integer iDVe,
            @RequestParam Integer iDSuKien,
            @RequestParam Integer iDDoiTac,
            @RequestParam String trangThaiDung
        ) {
    	if(iDVe==null ||iDSuKien==null||iDDoiTac==null ||trangThaiDung==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
        	Integer result = veService.updateTrangThaiDung(iDVe,iDSuKien,iDDoiTac,trangThaiDung);
            if (result==1) {
            	return new ResponseEntity<>(result, HttpStatus.OK);
            } else if(result==0) {
            	return new ResponseEntity<>(result,HttpStatus.NOT_FOUND);
            }
            return new ResponseEntity<>(result,HttpStatus.INTERNAL_SERVER_ERROR);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
    
    
    @PostMapping("/postVe")
    public ResponseEntity<Integer> createVe(@RequestBody VeDTO veDTO){
    	System.out.println("Trước bad request"+veDTO);
    	if(veDTO.getIdve()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(veDTO.getIdloaiVe()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(veDTO.getIdDoiTac()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(veDTO.getIdSuatDien()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	else if(veDTO.getIdsuKien()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	else if(veDTO.getSoSeri()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	else if(veDTO.getTrangThaiBan()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	else if(veDTO.getTrangThaiDung()==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	
        try {
        	System.out.println("Trước controller"+veDTO);
        	Integer result = veService.createVe(veDTO);
        	if (result==1) {
        		System.out.println("sau controller"+veDTO);
            	return new ResponseEntity<>(result, HttpStatus.CREATED);
        	} else
            return new ResponseEntity<>(result,HttpStatus.INTERNAL_SERVER_ERROR);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @PutMapping("/putMuaVe")
    public ResponseEntity<Integer> updateVe(
    		@RequestParam Integer iDVe,
            @RequestParam Integer iDLoaiVe,
            @RequestParam Integer iDSuKien,
            @RequestParam Integer iDSuatDien,
            @RequestParam Integer iDDoiTac,
            @RequestParam String soSeri,
            @RequestParam String trangThaiBan,
            @RequestParam String trangThaiDung) {
    	if(iDVe==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(iDLoaiVe==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(iDSuatDien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(iDDoiTac==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	else if(iDSuKien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	else if(soSeri==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	else if(trangThaiBan==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	else if(trangThaiDung==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
        try {
        	Integer result = veService.updateVe(iDVe, iDLoaiVe,iDSuatDien,iDDoiTac, iDSuKien, soSeri, trangThaiBan,trangThaiDung);
        	if (result==1) {
            	return new ResponseEntity<>(result, HttpStatus.OK);
            } else if(result==0) {
            	return new ResponseEntity<>(result,HttpStatus.NOT_FOUND);
            }
            return new ResponseEntity<>(result,HttpStatus.INTERNAL_SERVER_ERROR);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }

    @DeleteMapping("/deleteVe")
    public ResponseEntity<Integer> deleteVe(
    		@RequestParam Integer iDVe,
            @RequestParam Integer iDSuKien,
            @RequestParam Integer iDDoiTac) {
    	if(iDVe==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	else if(iDSuKien==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}else if(iDDoiTac==null) {
    		return new ResponseEntity<>(HttpStatus.BAD_REQUEST);
    	}
    	try {
    		Integer result = veService.deleteVe(iDVe, iDSuKien,iDDoiTac);
    		if (result==1) {
            	return new ResponseEntity<>(result, HttpStatus.OK);
            } else if(result==0) {
            	return new ResponseEntity<>(result,HttpStatus.NOT_FOUND);
            }
            return new ResponseEntity<>(result,HttpStatus.INTERNAL_SERVER_ERROR);
        } catch (Exception e) {
            return new ResponseEntity<>(HttpStatus.INTERNAL_SERVER_ERROR);
        }
    }
}
