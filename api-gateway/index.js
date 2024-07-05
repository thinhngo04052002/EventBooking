const express = require('express');
// Yêu cầu (import) thư viện Express để tạo ứng dụng web.

// Tạo một ứng dụng Express mới và gán nó cho biến `app`.
const app = express(); // Định nghĩa biến app ở đây
// cấu hình các port service
const port = 8001;
const portPurchase = 8002
const portLog = 8003
const portCRM = 8004
const portProduct = 8005
const portUser = 8006
const portStatistic = 8007
// Định nghĩa cổng mà server sẽ lắng nghe, ở đây là cổng 8001.

// Sử dụng middleware của Express để tự động phân tích các yêu cầu JSON và làm cho chúng có sẵn trong req.body.
app.use(express.json()); // Sử dụng app.use() sau khi đã định nghĩa app

var axios = require('axios');
// Yêu cầu (import) thư viện Axios để thực hiện các yêu cầu HTTP.

function makeAxiosRequest(body) {
    const headers = {
        "Content-Type": "application/json"
    }
    // Định nghĩa các headers cho yêu cầu HTTP, ở đây xác định kiểu nội dung là JSON.
    // Body truyền vào kiểu:
    // {"port":8083,
    //     "uri":"Log/addLogMuaVe",
    //     "body":{
    //         "idDoiTac": 133,
    //         "danhSachVe": [1, 2],
    //         "tongTien": 100,
    //         "idSuKien": 456,
    //         "idKhachHang": 789
    //     }
    // }   
    const data = body.body;
    // Lấy dữ liệu body từ đối tượng body được truyền vào hàm.

    const url = `http://127.0.0.1:${body.port}/${body.uri}`;
    // Tạo URL cho yêu cầu HTTP bằng cách sử dụng port và uri được truyền vào body.
    return axios({
        method: 'POST',
        url: url,
        headers: headers,
        data: data
    });
    // Thực hiện yêu cầu HTTP POST bằng Axios với URL, headers và dữ liệu đã định nghĩa.
}

app.post('/api', (req, res) => {
    const body = req.body;
    // Lấy dữ liệu từ body của yêu cầu POST.

    makeAxiosRequest(body)
        .then(response => {
            res.status(200).json(response.data);
            // Nếu yêu cầu Axios thành công, trả về dữ liệu từ response với mã trạng thái 200.
        })
        .catch(error => {
            res.status(500).json({ error: error.message });
            // Nếu có lỗi xảy ra trong yêu cầu Axios, trả về lỗi với mã trạng thái 500.
        });
});

app.get('/api/product', (req, res) => {
    const { uri } = req.query;
    // Lấy thông tin uri và port từ query parameters của yêu cầu GET.
    axios({
        method: 'GET',
        url: `http://127.0.0.1:${portProduct}/api/product/${uri}`,
    })
        .then(response => {
            res.status(200).json(response.data);
            // Nếu yêu cầu GET thành công, trả về dữ liệu từ response với mã trạng thái 200.
        })
        .catch(error => {
            res.status(500).json({ error: error.message });
            // Nếu có lỗi xảy ra trong yêu cầu GET, trả về lỗi với mã trạng thái 500.
        });
});


//product

app.post('/product', (req, res) => {
    const body = req.body;
    const { uri } = req.query;
    const headers = {
        "Content-Type": "application/json"
    }
    // Đảm bảo rằng uri được xử lý đúng
    // const url = `http://127.0.0.1:${portProduct}/product/${uri}`;
    // Tạo URL cho yêu cầu HTTP bằng cách sử dụng port và uri được truyền vào body.
    axios({
        method: 'POST',
        url: `http://127.0.0.1:${portProduct}/product/${uri}`,
        // headers: headers,
        data: body
    })
        .then(response => {
            res.status(200).json(response.data);
            // Nếu yêu cầu Axios thành công, trả về dữ liệu từ response với mã trạng thái 200.
        })
        .catch(error => {
            res.status(500).json({ error: error.message });
            // Nếu có lỗi xảy ra trong yêu cầu Axios, trả về lỗi với mã trạng thái 500.
        });
});
app.put('/product', (req, res) => {
    const body = req.body;
    const { uri } = req.query;

    // Đảm bảo rằng uri được xử lý đúng
    // const url = `http://127.0.0.1:${portProduct}/product/${uri}`;
    // Tạo URL cho yêu cầu HTTP bằng cách sử dụng port và uri được truyền vào body.
    axios({
        method: 'PUT',
        url: `http://127.0.0.1:${portProduct}/product/${uri}`,
        data: body
    })
        .then(response => {
            res.status(200).json(response.data);
            // Nếu yêu cầu Axios thành công, trả về dữ liệu từ response với mã trạng thái 200.
        })
        .catch(error => {
            res.status(500).json({ error: error.message });
            // Nếu có lỗi xảy ra trong yêu cầu Axios, trả về lỗi với mã trạng thái 500.
        });
});
app.get('/product', (req, res) => {
    const { uri } = req.query;
    // Lấy thông tin uri và port từ query parameters của yêu cầu GET.
    axios({
        method: 'GET',
        url: `http://127.0.0.1:${portProduct}/api/product/${uri}`,
    })
        .then(response => {
            res.status(200).json(response.data);
            // Nếu yêu cầu GET thành công, trả về dữ liệu từ response với mã trạng thái 200.
        })
        .catch(error => {
            res.status(500).json({ error: error.message });
            // Nếu có lỗi xảy ra trong yêu cầu GET, trả về lỗi với mã trạng thái 500.
        });
});

//crm
app.post('/crm', (req, res) => {
    const body = req.body;
    const { uri } = req.query;
    const headers = {
        "Content-Type": "application/json"
    }
    // Tạo URL cho yêu cầu HTTP bằng cách sử dụng port và uri được truyền vào body.
    axios({
        method: 'POST',
        url: `http://127.0.0.1:${portCRM}/${uri}`,
        // headers: headers,
        data: body
    })
        .then(response => {
            res.status(200).json(response.data);
            // Nếu yêu cầu Axios thành công, trả về dữ liệu từ response với mã trạng thái 200.
        })
        .catch(error => {
            res.status(500).json({ error: error.message });
            // Nếu có lỗi xảy ra trong yêu cầu Axios, trả về lỗi với mã trạng thái 500.
        });
});
app.get('/crm', (req, res) => {
    const { uri } = req.query;
    // Lấy thông tin uri và port từ query parameters của yêu cầu GET.
    axios({
        method: 'GET',
        url: `http://127.0.0.1:${portCRM}/${uri}`,
    })
        .then(response => {
            res.status(200).json(response.data);
            // Nếu yêu cầu GET thành công, trả về dữ liệu từ response với mã trạng thái 200.
        })
        .catch(error => {
            res.status(500).json({ error: error.message });
            // Nếu có lỗi xảy ra trong yêu cầu GET, trả về lỗi với mã trạng thái 500.
        });
});
//purchase
app.post('/purchase', (req, res) => {
    const body = req.body;
    const { uri } = req.query;
    const headers = {
        "Content-Type": "application/json"
    }
    // Tạo URL cho yêu cầu HTTP bằng cách sử dụng port và uri được truyền vào body.
    axios({
        method: 'POST',
        url: `http://127.0.0.1:${portPurchase}/${uri}`,
        // headers: headers,
        data: body
    })
        .then(response => {
            res.status(200).json(response.data);
            // Nếu yêu cầu Axios thành công, trả về dữ liệu từ response với mã trạng thái 200.
        })
        .catch(error => {
            res.status(500).json({ error: error.message });
            // Nếu có lỗi xảy ra trong yêu cầu Axios, trả về lỗi với mã trạng thái 500.
        });
});
app.get('/purchase', (req, res) => {
    const { uri } = req.query;
    // Lấy thông tin uri và port từ query parameters của yêu cầu GET.
    axios({
        method: 'GET',
        url: `http://127.0.0.1:${portPurchase}/${uri}`,
    })
        .then(response => {
            res.status(200).json(response.data);
            // Nếu yêu cầu GET thành công, trả về dữ liệu từ response với mã trạng thái 200.
        })
        .catch(error => {
            res.status(500).json({ error: error.message });
            // Nếu có lỗi xảy ra trong yêu cầu GET, trả về lỗi với mã trạng thái 500.
        });
});
//log
app.post('/log', (req, res) => {
    const body = req.body;
    const { uri } = req.query;
    const headers = {
        "Content-Type": "application/json"
    }
    // Tạo URL cho yêu cầu HTTP bằng cách sử dụng port và uri được truyền vào body.
    axios({
        method: 'POST',
        url: `http://127.0.0.1:${portLog}/${uri}`,
        // headers: headers,
        data: body
    })
        .then(response => {
            res.status(200).json(response.data);
            // Nếu yêu cầu Axios thành công, trả về dữ liệu từ response với mã trạng thái 200.
        })
        .catch(error => {
            res.status(500).json({ error: error.message });
            // Nếu có lỗi xảy ra trong yêu cầu Axios, trả về lỗi với mã trạng thái 500.
        });
});
app.get('/log', (req, res) => {
    const { uri } = req.query;
    // Lấy thông tin uri và port từ query parameters của yêu cầu GET.
    axios({
        method: 'GET',
        url: `http://127.0.0.1:${portLog}/${uri}`,
    })
        .then(response => {
            res.status(200).json(response.data);
            // Nếu yêu cầu GET thành công, trả về dữ liệu từ response với mã trạng thái 200.
        })
        .catch(error => {
            res.status(500).json({ error: error.message });
            // Nếu có lỗi xảy ra trong yêu cầu GET, trả về lỗi với mã trạng thái 500.
        });
});
//user
app.post('/user', (req, res) => {
    const body = req.body;
    const { uri } = req.query;
    const headers = {
        "Content-Type": "application/json"
    }
    // Tạo URL cho yêu cầu HTTP bằng cách sử dụng port và uri được truyền vào body.
    axios({
        method: 'POST',
        url: `http://127.0.0.1:${portUser}/${uri}`,
        // headers: headers,
        data: body
    })
        .then(response => {
            res.status(200).json(response.data);
            // Nếu yêu cầu Axios thành công, trả về dữ liệu từ response với mã trạng thái 200.
        })
        .catch(error => {
            res.status(500).json({ error: error.message });
            // Nếu có lỗi xảy ra trong yêu cầu Axios, trả về lỗi với mã trạng thái 500.
        });
});


app.get('/user', (req, res) => {
    const { uri } = req.query;
    // Lấy thông tin uri và port từ query parameters của yêu cầu GET.
    axios({
        method: 'GET',
        url: `http://127.0.0.1:${portUser}/${uri}`,
    })
        .then(response => {
            res.status(200).json(response.data);
            // Nếu yêu cầu GET thành công, trả về dữ liệu từ response với mã trạng thái 200.
        })
        .catch(error => {
            res.status(500).json({ error: error.message });
            // Nếu có lỗi xảy ra trong yêu cầu GET, trả về lỗi với mã trạng thái 500.
        });
});
//Statistic

app.post('/statistic', (req, res) => {
    const body = req.body;
    const { uri } = req.query;
    const headers = {
        "Content-Type": "application/json"
    }
    // Tạo URL cho yêu cầu HTTP bằng cách sử dụng port và uri được truyền vào body.
    axios({
        method: 'POST',
        url: `http://127.0.0.1:${portStatistic}/${uri}`,
        // headers: headers,
        data: body
    })
        .then(response => {
            res.status(200).json(response.data);
            // Nếu yêu cầu Axios thành công, trả về dữ liệu từ response với mã trạng thái 200.
        })
        .catch(error => {
            res.status(500).json({ error: error.message });
            // Nếu có lỗi xảy ra trong yêu cầu Axios, trả về lỗi với mã trạng thái 500.
        });
});
app.get('/statistic', (req, res) => {
    const { uri } = req.query;
    // Lấy thông tin uri và port từ query parameters của yêu cầu GET.
    axios({
        method: 'GET',
        url: `http://127.0.0.1:${portStatistic}/${uri}`,
    })
        .then(response => {
            res.status(200).json(response.data);
            // Nếu yêu cầu GET thành công, trả về dữ liệu từ response với mã trạng thái 200.
        })
        .catch(error => {
            res.status(500).json({ error: error.message });
            // Nếu có lỗi xảy ra trong yêu cầu GET, trả về lỗi với mã trạng thái 500.
        });
});

app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});
// Bắt đầu server và lắng nghe các yêu cầu trên cổng được định nghĩa. In ra thông báo khi server đang chạy.
