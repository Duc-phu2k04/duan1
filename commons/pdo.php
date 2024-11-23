<?php
/**
 * Mở kết nối đến CSDL sử dụng PDO
 * @throws PDOException lỗi kết nối
 */
function pdo_get_connection() {
    $dburl = "mysql:host=localhost;dbname=duan1_nhom2;charset=utf8"; // Thay đổi dbname nếu cần
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO($dburl, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        // Thông báo lỗi nếu không kết nối được
        throw new Exception("Kết nối thất bại: " . $e->getMessage());
    }
}
// File pdo.php
function pdo_execute_return_lastInsertId($sql)
{
    global $pdo; // Kết nối PDO đã được khởi tạo ở nơi khác trong mã nguồn
    $stmt = $pdo->prepare($sql); // Chuẩn bị câu lệnh SQL
    $stmt->execute(); // Thực thi câu lệnh SQL
    return $pdo->lastInsertId(); // Trả về ID của bản ghi vừa được chèn vào
}

/**
 * Thực thi câu lệnh sql thao tác dữ liệu (INSERT, UPDATE, DELETE)
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_execute($sql, $params = []) {
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params); // Truyền mảng tham số vào câu lệnh SQL
    } catch (PDOException $e) {
        throw new Exception("Lỗi thực thi câu lệnh: " . $e->getMessage());
    } finally {
        unset($conn);
    }
}




/**
 * Thực thi câu lệnh sql truy vấn dữ liệu (SELECT)
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return array mảng các bản ghi
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_query($sql) {
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng các bản ghi
    } catch (PDOException $e) {
        // Thông báo lỗi nếu thực thi thất bại
        throw new Exception("Lỗi thực thi câu lệnh truy vấn: " . $e->getMessage());
    } finally {
        unset($conn);
    }
}

/**
 * Thực thi câu lệnh sql truy vấn một bản ghi
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return array mảng chứa bản ghi
 * @throws PDOException lỗi thực thi câu lệnh
 */
/**
 * Thực thi câu lệnh sql truy vấn một bản ghi
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return array mảng chứa bản ghi
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_query_one($sql) {
    $sql_args = array_slice(func_get_args(), 1); // Lấy các tham số sau câu lệnh SQL
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        
        // Truyền tham số đúng dạng associative array
        if (count($sql_args) > 0) {
            $stmt->execute($sql_args[0]); // Truyền tham số đầu tiên (nếu có)
        } else {
            $stmt->execute(); // Nếu không có tham số thì chỉ gọi execute không tham số
        }
        
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về bản ghi đầu tiên
    } catch (PDOException $e) {
        throw new Exception("Lỗi thực thi câu lệnh truy vấn một bản ghi: " . $e->getMessage());
    } finally {
        unset($conn);
    }
}



/**
 * Thực thi câu lệnh sql truy vấn một giá trị
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return mixed giá trị
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_query_value($sql) {
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? array_values($row)[0] : null; // Trả về giá trị đầu tiên hoặc null nếu không có kết quả
    } catch (PDOException $e) {
        // Thông báo lỗi nếu thực thi thất bại
        throw new Exception("Lỗi thực thi câu lệnh truy vấn giá trị: " . $e->getMessage());
    } finally {
        unset($conn);
    }
}
?>
