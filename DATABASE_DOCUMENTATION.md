# Database Structure Documentation

## 📊 **Current Database Overview**

### **Tables Identified:**
1. `users` - User authentication and profiles
2. `barangays` - Barangay information
3. `schedules` - Waste collection schedules
4. `household_requests` - Household service requests
5. `password_reset_tokens` - Password reset functionality
6. `sessions` - User session management
7. `cache` - Application caching
8. `jobs` - Queue job management
9. `failed_jobs` - Failed queue jobs
10. `job_batches` - Job batching

---

## 🗂️ **Core Business Tables**

### **1. Users Table**
```sql
users (
    id (bigint, primary key)
    name (varchar)
    email (varchar, unique)
    email_verified_at (timestamp, nullable)
    password (varchar)
    role (varchar) -- super-admin, admin, barangay-official, resident
    barangay_id (bigint, foreign key)
    remember_token (varchar)
    created_at (timestamp)
    updated_at (timestamp)
)
```

**Relationships:**
- `belongsTo(Barangay)` - User belongs to a barangay
- `hasMany(HouseholdRequest)` - User can create requests
- `hasMany(Schedule)` - User can create schedules

### **2. Barangays Table**
```sql
barangays (
    id (bigint, primary key)
    name (varchar)
    captain_name (varchar)
    contact_number (varchar)
    address (text)
    postal_code (varchar)
    latitude (decimal)
    longitude (decimal)
    population (integer)
    status (varchar) -- active, inactive
    description (text)
    created_at (timestamp)
    updated_at (timestamp)
)
```

**Relationships:**
- `hasMany(User)` - Barangay has many users
- `hasMany(Schedule)` - Barangay has many schedules
- `hasMany(HouseholdRequest)` - Barangay has many requests

### **3. Schedules Table**
```sql
schedules (
    id (bigint, primary key)
    barangay_id (bigint, foreign key)
    truck_id (bigint, foreign key)
    title (varchar)
    description (text)
    waste_type (varchar) -- general, recyclable, hazardous, etc.
    day_of_week (varchar) -- monday, tuesday, etc.
    collection_start_time (time)
    collection_end_time (time)
    collection_point (varchar)
    status (varchar) -- active, inactive
    special_instructions (text)
    created_by (bigint, foreign key)
    created_at (timestamp)
    updated_at (timestamp)
    deleted_at (timestamp) -- soft deletes
)
```

**Relationships:**
- `belongsTo(Barangay)` - Schedule belongs to barangay
- `belongsTo(User, 'created_by')` - Schedule created by user
- `belongsTo(Truck)` - Schedule assigned to truck

### **4. Household Requests Table**
```sql
household_requests (
    id (bigint, primary key)
    household_name (varchar)
    household_head (varchar)
    contact_number (varchar)
    email (varchar)
    address_description (text)
    barangay_id (bigint, foreign key)
    request_status (varchar) -- pending, approved, rejected
    rejection_reason (text)
    verification_notes (text)
    processed_by (bigint, foreign key)
    processed_at (timestamp)
    created_user_id (bigint, foreign key)
    created_at (timestamp)
    updated_at (timestamp)
)
```

**Relationships:**
- `belongsTo(Barangay)` - Request belongs to barangay
- `belongsTo(User, 'processed_by')` - Request processed by user
- `belongsTo(User, 'created_user_id')` - Request created by user

---

## 🔍 **Normalization Analysis**

### **Current Issues Identified:**

#### **1. User Table Denormalization**
- **Issue**: `role` field stores string values instead of foreign key
- **Impact**: No referential integrity, hard to maintain role permissions
- **Solution**: Create separate `roles` table

#### **2. Schedule Table Denormalization**
- **Issue**: `waste_type` and `day_of_week` as strings
- **Impact**: Inconsistent data, hard to filter/group
- **Solution**: Create lookup tables

#### **3. Household Request Denormalization**
- **Issue**: `request_status` as string
- **Impact**: No validation, inconsistent status values
- **Solution**: Create status lookup table

#### **4. Missing Truck Table**
- **Issue**: `truck_id` foreign key but no truck table
- **Impact**: Broken relationship, data integrity issues
- **Solution**: Create `trucks` table

---

## 📋 **Recommended Normalization**

### **New Tables to Create:**

#### **1. Roles Table**
```sql
roles (
    id (bigint, primary key)
    name (varchar) -- super-admin, admin, barangay-official, resident
    display_name (varchar)
    description (text)
    permissions (json) -- store permissions as JSON
    created_at (timestamp)
    updated_at (timestamp)
)
```

#### **2. Waste Types Table**
```sql
waste_types (
    id (bigint, primary key)
    name (varchar) -- general, recyclable, hazardous, organic
    display_name (varchar)
    description (text)
    color_code (varchar) -- for UI display
    created_at (timestamp)
    updated_at (timestamp)
)
```

#### **3. Days of Week Table**
```sql
days_of_week (
    id (bigint, primary key)
    name (varchar) -- monday, tuesday, etc.
    display_name (varchar)
    sort_order (integer)
    created_at (timestamp)
    updated_at (timestamp)
)
```

#### **4. Request Statuses Table**
```sql
request_statuses (
    id (bigint, primary key)
    name (varchar) -- pending, approved, rejected
    display_name (varchar)
    color (varchar) -- for UI badges
    description (text)
    created_at (timestamp)
    updated_at (timestamp)
)
```

#### **5. Trucks Table**
```sql
trucks (
    id (bigint, primary key)
    truck_number (varchar)
    plate_number (varchar)
    capacity (decimal)
    waste_type_id (bigint, foreign key)
    status (varchar) -- active, maintenance, retired
    driver_id (bigint, foreign key)
    created_at (timestamp)
    updated_at (timestamp)
)
```

#### **6. Barangay Statuses Table**
```sql
barangay_statuses (
    id (bigint, primary key)
    name (varchar) -- active, inactive
    display_name (varchar)
    description (text)
    created_at (timestamp)
    updated_at (timestamp)
)
```

---

## 🔄 **Migration Strategy**

### **Phase 1: Create Lookup Tables**
1. Create new normalized tables
2. Seed with current data
3. Update models with new relationships

### **Phase 2: Update Foreign Keys**
1. Add foreign key columns to existing tables
2. Migrate string data to foreign keys
3. Update model relationships

### **Phase 3: Remove Denormalized Columns**
1. Remove old string columns
2. Update queries and views
3. Test all functionality

### **Phase 4: Update Dashboard Code**
1. Update analytics queries
2. Modify chart data sources
3. Test dashboard functionality

---

## ⚠️ **Impact on Current Code**

### **Files That Need Updates:**

#### **Models:**
- `User.php` - Update role relationship
- `Schedule.php` - Update waste_type and day_of_week relationships
- `HouseholdRequest.php` - Update status relationship
- `Barangay.php` - Update status relationship

#### **Dashboard Components:**
- `SuperAdmin/Dashboard.php` - Update analytics queries
- `Admin/Dashboard.php` - Update analytics queries
- `Barangay/Dashboard.php` - Update analytics queries

#### **Views:**
- All dashboard views - Update data display
- Chart configurations - Update data sources

---

## 🛡️ **Safety Measures**

### **Before Making Changes:**
1. ✅ **Database Backup** - Already done
2. ✅ **GitHub Code Backup** - Recommended
3. ⏳ **Create Test Environment** - In progress
4. ⏳ **Document Current Structure** - This document

### **During Migration:**
1. Use database transactions
2. Test each phase thoroughly
3. Keep rollback plan ready
4. Monitor application performance

### **After Migration:**
1. Verify all functionality works
2. Test dashboard analytics
3. Check data integrity
4. Update documentation

---

## 📊 **Benefits of Normalization**

### **Data Integrity:**
- ✅ Referential integrity
- ✅ Consistent data values
- ✅ Reduced data redundancy
- ✅ Better validation

### **Performance:**
- ✅ Faster queries with proper indexes
- ✅ Better join performance
- ✅ Reduced storage space
- ✅ Optimized analytics

### **Maintainability:**
- ✅ Easier to add new values
- ✅ Centralized data management
- ✅ Better code organization
- ✅ Simplified testing

---

## 🚀 **Next Steps**

1. **Review this documentation** and confirm accuracy
2. **Create test environment** for safe experimentation
3. **Start with Phase 1** - Create lookup tables
4. **Test thoroughly** before proceeding to next phase
5. **Update code gradually** to maintain functionality

---

*Last Updated: {{ now()->format('F j, Y H:i:s') }}*
*Document Version: 1.0* 