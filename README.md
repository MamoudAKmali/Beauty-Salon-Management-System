<div align="center">

# 💅 لؤلؤة | Beauty Salon Management System

**نظام إدارة صالون تجميل متكامل مبني بـ PHP وMySQL**

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-MariaDB-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.x-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

> منصة ويب احترافية لإدارة صالون التجميل "لؤلؤة"، تتيح للعميلات حجز المواعيد إلكترونياً والتحكم في جميع خدمات الصالون من لوحة تحكم مخصصة للمدير.

</div>

---

## 📋 جدول المحتويات

- [🌟 نظرة عامة](#-نظرة-عامة)
- [✨ الميزات الرئيسية](#-الميزات-الرئيسية)
- [🛠️ التقنيات المستخدمة](#%EF%B8%8F-التقنيات-المستخدمة)
- [🗂️ هيكل المشروع](#%EF%B8%8F-هيكل-المشروع)
- [🗄️ قاعدة البيانات](#%EF%B8%8F-قاعدة-البيانات)
- [🚀 تثبيت وتشغيل المشروع](#-تثبيت-وتشغيل-المشروع)
- [👤 بيانات الدخول الافتراضية](#-بيانات-الدخول-الافتراضية)
- [📸 لقطات الشاشة](#-لقطات-الشاشة)
- [🤝 المساهمة](#-المساهمة)
- [👤 المؤلف](#-المؤلف)
- [📄 الرخصة](#-الرخصة)

---

## 🌟 نظرة عامة

**لؤلؤة** هو تطبيق ويب متكامل لإدارة صالونات التجميل، يوفر واجهة أنيقة للعميلات لحجز المواعيد واختيار الخدمات، بالإضافة إلى لوحة تحكم شاملة للمسؤولين لإدارة العمليات اليومية. يتميز بدعم كامل للغة العربية وتصميم يتوافق مع معايير الـ RTL.

---

## ✨ الميزات الرئيسية

### 👩‍💼 للعميلات
| الميزة | الوصف |
|--------|-------|
| 🏠 **الصفحة الرئيسية** | واجهة ترحيبية أنيقة مع عرض الخدمات المميزة والمزايا |
| 📅 **الحجز الإلكتروني** | حجز موعد بسهولة مع اختيار الخدمة والموظفة والوقت |
| 💄 **صفحة الخدمات** | استعراض جميع الخدمات مع الأسعار والتفاصيل |
| ⭐ **التقييمات والمراجعات** | قراءة وكتابة تقييمات الخدمات والموظفات |
| 🔐 **نظام تسجيل الحسابات** | إنشاء حساب شخصي وتسجيل الدخول بأمان |
| 🏆 **نقاط الولاء** | نظام مكافآت يُحتسب تلقائياً مع كل حجز |

### 🛠️ للمسؤول (Admin Panel)
| الميزة | الوصف |
|--------|-------|
| 📊 **لوحة القيادة** | إحصائيات شاملة عن المواعيد والعملاء والخدمات |
| 📋 **إدارة المواعيد** | عرض وتحديث حالات المواعيد (انتظار / مؤكد / مكتمل / ملغي) |
| 💼 **إدارة الخدمات** | إضافة وتعديل وحذف الخدمات مع الأسعار والصور |
| 👥 **إدارة الموظفات** | إدارة بيانات الموظفات والتخصصات |
| 🔒 **حماية متكاملة** | نظام صلاحيات للتمييز بين المسؤول والعميل |

---

## 🛠️ التقنيات المستخدمة

| التقنية | الاستخدام |
|---------|-----------|
| ![PHP](https://img.shields.io/badge/-PHP%208.x-777BB4?logo=php&logoColor=white) | Backend & Server-side Logic |
| ![MySQL](https://img.shields.io/badge/-MySQL%20/%20MariaDB-4479A1?logo=mysql&logoColor=white) | Relational Database |
| ![Bootstrap](https://img.shields.io/badge/-Bootstrap%205-7952B3?logo=bootstrap&logoColor=white) | Responsive UI Framework |
| ![CSS3](https://img.shields.io/badge/-Custom%20CSS3-1572B6?logo=css3&logoColor=white) | Custom Styling & Animations |
| ![Font Awesome](https://img.shields.io/badge/-Font%20Awesome-528DD7?logo=font-awesome&logoColor=white) | Icons Library |
| PDO | Secure Database Abstraction Layer |
| Sessions | Authentication & State Management |

---

## 🗂️ هيكل المشروع

```
Beauty-Salon/
│
├── 📄 index.php              # الصفحة الرئيسية
├── 📄 book.php               # صفحة الحجز الإلكتروني
├── 📄 services.php           # صفحة الخدمات
├── 📄 reviews.php            # صفحة التقييمات
├── 📄 login.php              # صفحة تسجيل الدخول
├── 📄 register.php           # صفحة إنشاء حساب
├── 📄 logout.php             # تسجيل الخروج
│
├── 📁 admin/                 # لوحة تحكم المسؤول
│   ├── index.php             # لوحة القيادة (Dashboard)
│   ├── appointments.php      # إدارة المواعيد
│   ├── services.php          # إدارة الخدمات
│   ├── header.php            # رأس لوحة التحكم
│   ├── footer.php            # ذيل لوحة التحكم
│   └── logout.php            # تسجيل خروج المسؤول
│
├── 📁 includes/              # الملفات المشتركة
│   ├── db.php                # إعداد اتصال قاعدة البيانات (PDO)
│   ├── header.php            # رأس الموقع العام
│   └── footer.php            # ذيل الموقع العام
│
├── 📁 assets/                # الأصول الثابتة
│   ├── css/
│   │   └── style.css         # ملف الأنماط الرئيسي
│   ├── js/                   # ملفات JavaScript
│   └── img/
│       └── services/         # صور الخدمات
│
└── 📁 database/
    └── beauty_salon_db.sql   # ملف قاعدة البيانات (SQL Dump)
```

---

## 🗄️ قاعدة البيانات

يستخدم المشروع قاعدة بيانات **MySQL / MariaDB** تحتوي على الجداول التالية:

```
beauty_salon_db
├── customers       # بيانات العملاء والمسؤولين (name, phone, email, role, loyalty_points)
├── services        # الخدمات المقدمة (name, category, price, duration, image)
├── employees       # بيانات الموظفات (name, specialization, phone, bio)
├── appointments    # المواعيد المحجوزة (customer_id, service_id, employee_id, date, time, status)
└── reviews         # التقييمات (customer_id, service_id, employee_id, rating, comment)
```

### 🔗 العلاقات بين الجداول
```
customers ──┬──< appointments >──── services
            │         │
            │         └──────────── employees
            │
            └──────< reviews >───── services
                                └── employees
```

> **ملاحظة:** تستخدم جميع العلاقات `ON DELETE CASCADE` لضمان سلامة البيانات.

---

## 🚀 تثبيت وتشغيل المشروع

### المتطلبات الأساسية
- ✅ **PHP** >= 7.4 (يُفضل 8.x)
- ✅ **MySQL** >= 5.7 أو **MariaDB** >= 10.x
- ✅ **Apache** أو أي خادم ويب يدعم PHP
- ✅ **XAMPP** / **WAMP** / **LAMP** (للبيئة المحلية)

### خطوات التثبيت

**1. استنساخ المستودع**
```bash
git clone https://github.com/MamoudAKmali/Beauty-Salon-Management-System.git
cd Beauty-Salon-Management-System
```

**2. نقل الملفات إلى مجلد الخادم**
```bash
# لـ XAMPP على Windows
cp -r Beauty-Salon/ C:/xampp/htdocs/

# لـ LAMP على Linux
cp -r Beauty-Salon/ /var/www/html/
```

**3. إنشاء قاعدة البيانات**
```bash
# افتح phpMyAdmin أو استخدم MySQL CLI
mysql -u root -p

# داخل MySQL
CREATE DATABASE beauty_salon_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE beauty_salon_db;

# استيراد ملف SQL
source /path/to/database/beauty_salon_db.sql;
```

أو من phpMyAdmin:
1. اذهب إلى `http://localhost/phpmyadmin`
2. أنشئ قاعدة بيانات باسم `beauty_salon_db`
3. انتقل إلى تبويب **Import** وارفع ملف `database/beauty_salon_db.sql`

**4. ضبط إعدادات قاعدة البيانات**

افتح ملف `includes/db.php` وتأكد من صحة الإعدادات:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'beauty_salon_db');
define('DB_USER', 'root');      // غيّره إلى مستخدمك
define('DB_PASS', '');          // أضف كلمة مرورك إن وجدت
define('DB_CHARSET', 'utf8mb4');
```

**5. تشغيل المشروع**

افتح المتصفح وانتقل إلى:
```
http://localhost/Beauty-Salon/
```

---

## 👤 بيانات الدخول الافتراضية

> ⚠️ **تحذير أمني:** يُرجى تغيير بيانات الدخول الافتراضية فور تثبيت المشروع على أي بيئة إنتاجية.

| النوع | البريد الإلكتروني | كلمة المرور |
|------|-----------------|-------------|
| 🔴 **مسؤول (Admin)** | `admin@salon.com` | `admin123` |
| 🟢 **عميلة** | `rahaf@gmail.com` | (مشفر في قاعدة البيانات) |

للوصول إلى لوحة التحكم:
```
http://localhost/Beauty-Salon/admin/
```

---

## 🔒 الأمان

- ✅ جميع كلمات المرور مشفرة باستخدام `password_hash()` و `bcrypt`
- ✅ حماية من **SQL Injection** عبر **PDO Prepared Statements**
- ✅ حماية من **XSS** باستخدام `htmlspecialchars()`
- ✅ نظام **Sessions** لإدارة حالة المصادقة
- ✅ تحقق من الصلاحيات (Admin / Customer) في كل صفحة محمية

---

## 📸 لقطات الشاشة

| الصفحة | الوصف |
|--------|-------|
| 🏠 الصفحة الرئيسية | واجهة أنيقة مع قسم Hero وعرض الخدمات |
| 💄 صفحة الخدمات | بطاقات الخدمات مع الأسعار والتصنيفات |
| 📅 صفحة الحجز | نموذج حجز موعد متكامل |
| 📊 لوحة التحكم | إحصائيات وجدول المواعيد الحديثة |

---

## 🤝 المساهمة

نرحب بمساهماتكم! إذا أردتم المساهمة في تطوير المشروع:

1. **Fork** المستودع
2. أنشئ فرعاً جديداً: `git checkout -b feature/اسم-الميزة`
3. أضف تعديلاتك: `git commit -m 'إضافة: وصف التعديل'`
4. ارفع التغييرات: `git push origin feature/اسم-الميزة`
5. افتح **Pull Request**

### تقرير المشكلات
إذا واجهتم أي مشكلة، يرجى فتح [Issue](../../issues) مع وصف واضح للمشكلة وخطوات إعادة إنتاجها.

---

## 👤 المؤلف

- **Mamoud AKmali** - [GitHub Profile](https://github.com/MamoudAKmali)

---

## 📄 الرخصة

هذا المشروع مرخص تحت رخصة **MIT** — راجع ملف [LICENSE](LICENSE) للمزيد من التفاصيل.

---

<div align="center">

**صُنع بـ ❤️ لتجربة تجميل استثنائية**

⭐ لا تنسَ إعطاء المشروع نجمة إذا أعجبك!

</div>
