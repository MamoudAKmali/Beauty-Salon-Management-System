<?php
session_start();
$current_admin_page = "services";
require_once '../includes/db.php';

// Handle Add/Edit/Delete
$action = $_GET['action'] ?? 'list';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_service'])) {
        $id = $_POST['id'] ?? '';
        $name = $_POST['name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $duration = $_POST['duration'];
        $description = $_POST['description'];
        
        $image = null;
        if ($id) {
            $stmt = $pdo->prepare("SELECT image FROM services WHERE id=?");
            $stmt->execute([$id]);
            $image = $stmt->fetchColumn();
        }

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = '../assets/img/services/';
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
            $filename = time() . '_' . basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $filename)) {
                $image = 'assets/img/services/' . $filename;
            }
        }

        try {
            if ($id) {
                // Update
                $stmt = $pdo->prepare("UPDATE services SET name=?, category=?, price=?, duration_minutes=?, description=?, image=? WHERE id=?");
                $stmt->execute([$name, $category, $price, $duration, $description, $image, $id]);
                $_SESSION['flash_message'] = "تم تحديث الخدمة بنجاح.";
            } else {
                // Insert
                $stmt = $pdo->prepare("INSERT INTO services (name, category, price, duration_minutes, description, image) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$name, $category, $price, $duration, $description, $image]);
                $_SESSION['flash_message'] = "تم إضافة الخدمة بنجاح.";
            }
            $_SESSION['flash_type'] = "success";
            header("Location: services.php");
            exit;
        } catch(PDOException $e) {
            $error = "حدث خطأ: " . $e->getMessage();
        }
    } elseif (isset($_POST['delete_service'])) {
        $id = $_POST['delete_id'];
        try {
            $stmt = $pdo->prepare("DELETE FROM services WHERE id=?");
            $stmt->execute([$id]);
            $_SESSION['flash_message'] = "تم حذف الخدمة بنجاح.";
            $_SESSION['flash_type'] = "success";
        } catch(PDOException $e) {
            $_SESSION['flash_message'] = "لا يمكن حذف خدمة مرتبطة بمواعيد سابقة.";
            $_SESSION['flash_type'] = "danger";
        }
        header("Location: services.php");
        exit;
    }
}

// Fetch data for edit form
$edit_service = null;
if ($action === 'edit' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $edit_service = $stmt->fetch();
}

require_once 'header.php';
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">إدارة الخدمات</h1>
    <?php if($action === 'list'): ?>
        <a href="services.php?action=add" class="btn btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> إضافة خدمة جديدة</a>
    <?php else: ?>
        <a href="services.php" class="btn btn-secondary shadow-sm"><i class="fas fa-arrow-right fa-sm text-white-50"></i> العودة للقائمة</a>
    <?php endif; ?>
</div>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<?php if ($action === 'list'): ?>
    <?php
        $services = $pdo->query("SELECT * FROM services ORDER BY category, name")->fetchAll();
    ?>
    <div class="card shadow mb-4 border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>الاسم</th>
                            <th>الفئة</th>
                            <th>السعر</th>
                            <th>المدة</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($services as $srv): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($srv['name']) ?></strong></td>
                            <td><?= htmlspecialchars($srv['category']) ?></td>
                            <td><?= number_format($srv['price'], 0) ?> رس</td>
                            <td><?= $srv['duration_minutes'] ?> دقيقة</td>
                            <td>
                                <span class="badge <?= $srv['is_active'] ? 'bg-success' : 'bg-secondary' ?>">
                                    <?= $srv['is_active'] ? 'نشط' : 'غير نشط' ?>
                                </span>
                            </td>
                            <td>
                                <a href="services.php?action=edit&id=<?= $srv['id'] ?>" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="services.php" class="d-inline" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                    <input type="hidden" name="delete_id" value="<?= $srv['id'] ?>">
                                    <button type="submit" name="delete_service" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if(empty($services)): ?>
                        <tr><td colspan="6" class="text-center">لا توجد خدمات مضافة.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php elseif ($action === 'add' || $action === 'edit'): ?>

    <div class="card shadow mb-4 border-0 w-75">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary"><?= $action === 'edit' ? 'تعديل خدمة' : 'إضافة خدمة جديدة' ?></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="services.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $edit_service['id'] ?? '' ?>">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">اسم الخدمة <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($edit_service['name'] ?? '') ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">الفئة <span class="text-danger">*</span></label>
                        <select name="category" class="form-select" required>
                            <?php 
                            $cats = ['hair'=>'شعر', 'nails'=>'أظافر', 'makeup'=>'مكياج', 'skincare'=>'بشرة', 'eyebrow'=>'حواجب', 'other'=>'أخرى'];
                            $selected = $edit_service['category'] ?? '';
                            foreach($cats as $k => $v): ?>
                                <option value="<?= $k ?>" <?= $selected == $k ? 'selected' : '' ?>><?= $v ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">السعر (رس) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="price" class="form-control" required value="<?= htmlspecialchars($edit_service['price'] ?? '') ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">المدة الزمنية (دقائق) <span class="text-danger">*</span></label>
                        <input type="number" name="duration" class="form-control" required value="<?= htmlspecialchars($edit_service['duration_minutes'] ?? '60') ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">صورة الخدمة (اختياري)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <?php if(!empty($edit_service['image'])): ?>
                            <div class="mt-2">
                                <img src="../<?= htmlspecialchars($edit_service['image']) ?>" alt="صورة الخدمة" style="height: 80px; border-radius: 5px; object-fit: cover;">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-12 mb-4">
                        <label class="form-label">الوصف</label>
                        <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($edit_service['description'] ?? '') ?></textarea>
                    </div>
                </div>
                
                <button type="submit" name="save_service" class="btn btn-primary"><i class="fas fa-save"></i> حفظ البيانات</button>
                <a href="services.php" class="btn btn-secondary">إلغاء</a>
            </form>
        </div>
    </div>

<?php endif; ?>

<?php require_once 'footer.php'; ?>
