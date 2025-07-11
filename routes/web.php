<?php

use App\Http\Controllers\admin\AssignTaskController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CaseController;
use App\Http\Controllers\admin\CaseReportController;
use App\Http\Controllers\admin\ClientReportController;
use App\Http\Controllers\admin\CompanyController;
use App\Http\Controllers\admin\CompletedDestructionController;
use App\Http\Controllers\admin\CurrencyController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\EvidenceController;
use App\Http\Controllers\admin\ExpensesController;
use App\Http\Controllers\admin\FinanceController;
use App\Http\Controllers\admin\FinanceReportController;
use App\Http\Controllers\admin\GroupController;
use App\Http\Controllers\admin\InvestigationController;
use App\Http\Controllers\admin\InvoiceController;
use App\Http\Controllers\admin\PendingDestructionController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\RaidDocController;
use App\Http\Controllers\admin\RaidPlainingController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SubDepartmentController;
use App\Http\Controllers\admin\TasksController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/edit/profile', [ProfileController::class, 'editProfile'])->name('edit.profile');


    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


    // Brand
    Route::get('/brand/index', [BrandController::class, 'brandIndex'])->name('brand.index');
    Route::get('/brand/create', [BrandController::class, 'brandCreate'])->name('brand.create');
    Route::post('/brand/store', [BrandController::class, 'brandStore'])->name('brand.store');
    Route::get('/brand/edit/{id}', [BrandController::class, 'brandEdit'])->name('brand.edit');
    Route::post('/brand/update/{id}', [BrandController::class, 'brandUpdate'])->name('brand.update');
    Route::get('/brand/destroy/{id}', [BrandController::class, 'brandDestroy'])->name('brand.destroy');
    Route::post('/brand/update-status/{id}', [BrandController::class, 'updateBrandStatus']);
    Route::get('/brand/sort', [BrandController::class, 'sortBrand'])->name('brand.sort');


    // Company
    Route::get('/company/index', [CompanyController::class, 'companyIndex'])->name('company.index');
    Route::get('/company/create', [CompanyController::class, 'companyCreate'])->name('company.create');
    Route::post('/company/store', [CompanyController::class, 'companyStore'])->name('company.store');
    Route::get('/company/view/{id}', [CompanyController::class, 'companyView'])->name('company.view');
    Route::get('/company/edit/{id}', [CompanyController::class, 'companyEdit'])->name('company.edit');
    Route::post('/company/update/{id}', [CompanyController::class, 'companyUpdate'])->name('company.update');
    Route::get('/company/destroy/{id}', [CompanyController::class, 'companyDestroy'])->name('company.destroy');
    Route::post('/company/update-status/{id}', [CompanyController::class, 'updateStatus']);
    Route::get('/company/sort', [CompanyController::class, 'sortCompany'])->name('company.sort');


    // User
    Route::get('/user/index', [UserController::class, 'userIndex'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'userCreate'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'userStore'])->name('user.store');
    Route::get('/user/view/{id}', [UserController::class, 'userView'])->name('user.view');
    Route::get('/user/edit/{id}', [UserController::class, 'userEdit'])->name('user.edit');
    Route::post('/user/update/{id}', [UserController::class, 'userUpdate'])->name('user.update');
    Route::get('/user/destroy/{id}', [UserController::class, 'userDestroy'])->name('user.destroy');
    Route::post('/user/update-status/{id}', [UserController::class, 'updateUserStatus']);
    Route::get('/user/sort', [UserController::class, 'sortUser'])->name('user.sort');

    // Product
    Route::get('/product/index', [ProductController::class, 'productIndex'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'productCreate'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'productStore'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'productEdit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'productUpdate'])->name('product.update');
    Route::get('/product/destroy/{id}', [ProductController::class, 'productDestroy'])->name('product.destroy');
    Route::post('/product/update-status/{id}', [ProductController::class, 'updateProductStatus']);
    Route::get('/product/sort', [ProductController::class, 'sortProduct'])->name('product.sort');
    Route::get('/product/profile/{id}', [ProductController::class, 'productProfile'])->name('product.profile');
    // Brand Profile
    Route::get('/brand-profile/{id}', [ProductController::class, 'productBrandProfile'])->name('product.brand.profile');

    // Case
    Route::get('/case/index', [CaseController::class, 'caseIndex'])->name('case.index');
    Route::get('/case/create', [CaseController::class, 'caseCreate'])->name('case.create');
    Route::post('/case/store', [CaseController::class, 'caseStore'])->name('case.store');
    Route::get('/case/view/{id}', [CaseController::class, 'caseView'])->name('case.view');
    Route::get('/case/edit/{id}', [CaseController::class, 'caseEdit'])->name('case.edit');
    Route::post('/case/update/{id}', [CaseController::class, 'caseUpdate'])->name('case.update');
    Route::get('/case/destroy/{id}', [CaseController::class, 'caseDestroy'])->name('case.destroy');
    Route::get('/get-case-data/{id}', [CaseController::class, 'getCaseData'])->name('get.case.data');
    Route::get('/cases/sort', [CaseController::class, 'sortCases'])->name('case.sort');
    Route::get('/get-company-brands/{companyId}', [CaseController::class, 'getCompanyBrands']);
    Route::get('/get-brand-products/{brandId}', [CaseController::class, 'getBrandProducts']);



    // Case
    Route::get('/investigation/index', [InvestigationController::class, 'investigationIndex'])->name('investigation.index');
    Route::get('/investigation/create', [InvestigationController::class, 'investigationCreate'])->name('investigation.create');
    Route::post('/investigation/store', [InvestigationController::class, 'investigationStore'])->name('investigation.store');
    Route::get('/investigation/edit/{id}', [InvestigationController::class, 'investigationEdit'])->name('investigation.edit');
    Route::get('/investigation/view/{id}', [InvestigationController::class, 'investigationView'])->name('investigation.view');
    Route::post('/investigation/update/{id}', [InvestigationController::class, 'investigationUpdate'])->name('investigation.update');
    Route::get('/investigation/destroy/{id}', [InvestigationController::class, 'investigationDestroy'])->name('investigation.destroy');
    Route::get('/investigation/sort', [InvestigationController::class, 'sortInvestigation'])->name('investigation.sort');


    // Tasks
    Route::get('/tasks/index', [TasksController::class, 'tasksIndex'])->name('tasks.index');
    Route::get('/tasks/create', [TasksController::class, 'tasksCreate'])->name('tasks.create');
    Route::post('/tasks/store', [TasksController::class, 'tasksStore'])->name('tasks.store');
    Route::get('/tasks/view/{id}', [TasksController::class, 'tasksView'])->name('tasks.view');
    Route::get('/tasks/edit/{id}', [TasksController::class, 'tasksEdit'])->name('tasks.edit');
    Route::post('/tasks/update/{id}', [TasksController::class, 'tasksUpdate'])->name('tasks.update');
    Route::get('/tasks/destroy/{id}', [TasksController::class, 'tasksDestroy'])->name('tasks.destroy');
    Route::get('/tasks/sort', [TasksController::class, 'sortTask'])->name('tasks.sort');

    // Evidence
    Route::get('/evidence/index', [EvidenceController::class, 'evidenceIndex'])->name('evidence.index');
    Route::get('/evidence/create', [EvidenceController::class, 'evidenceCreate'])->name('evidence.create');
    Route::post('/evidence/store', [EvidenceController::class, 'evidenceStore'])->name('evidence.store');
    Route::get('/evidence/view/{id}', [EvidenceController::class, 'evidenceView'])->name('evidence.view');
    Route::get('/evidence/edit/{id}', [EvidenceController::class, 'evidenceEdit'])->name('evidence.edit');
    Route::post('/evidence/update/{id}', [EvidenceController::class, 'evidenceUpdate'])->name('evidence.update');
    Route::get('/evidence/destroy/{id}', [EvidenceController::class, 'evidenceDestroy'])->name('evidence.destroy');
    Route::get('/evidence/sort', [EvidenceController::class, 'sortEvidence'])->name('evidence.sort');

    // Assign Tasks
    Route::get('/assign-tasks/index', [AssignTaskController::class, 'assignTasksIndex'])->name('assign.tasks.index');
    Route::get('/assign-tasks/create', [AssignTaskController::class, 'assignTasksCreate'])->name('assign.tasks.create');
    Route::post('/assign-tasks/store', [AssignTaskController::class, 'assignTasksStore'])->name('assign.tasks.store');
    Route::get('/assign-tasks/view/{id}', [AssignTaskController::class, 'assignTasksView'])->name('assign.tasks.view');
    Route::get('/assign-tasks/edit/{id}', [AssignTaskController::class, 'assignTasksEdit'])->name('assign.tasks.edit');
    Route::post('/assign-tasks/update/{id}', [AssignTaskController::class, 'assignTasksUpdate'])->name('assign.tasks.update');
    Route::get('/assign-tasks/destroy/{id}', [AssignTaskController::class, 'assignTasksDestroy'])->name('assign.tasks.destroy');
     Route::get('/assign-tasks/sort', [AssignTaskController::class, 'sortassignTasks'])->name('assign.tasks.sort');
      Route::post('/assign-tasks/update-status/{id}', [AssignTaskController::class, 'updateStatus']);

      // Group
    Route::get('/groups/index', [GroupController::class, 'groupIndex'])->name('group.index');
    Route::get('/groups/create', [GroupController::class, 'groupCreate'])->name('group.create');
    Route::post('/groups/store', [GroupController::class, 'groupStore'])->name('group.store');
    Route::get('/groups/view/{id}', [GroupController::class, 'groupView'])->name('group.view');
    Route::get('/groups/edit/{id}', [GroupController::class, 'groupEdit'])->name('group.edit');
    Route::post('/groups/update/{id}', [GroupController::class, 'groupUpdate'])->name('group.update');
    Route::get('/groups/destroy/{id}', [GroupController::class, 'groupDestroy'])->name('group.destroy');
    Route::get('/groups/sort', [GroupController::class, 'sortgroup'])->name('group.sort');
    Route::post('/groups/update-status/{id}', [GroupController::class, 'updateStatus']);

    // Raid Plaining
    Route::get('/raid-plaining/index', [RaidPlainingController::class, 'raidPlainingIndex'])->name('raid.plaining.index');
    Route::get('/raid-plaining/create', [RaidPlainingController::class, 'raidPlainingCreate'])->name('raid.plaining.create');
    Route::post('/raid-plaining/store', [RaidPlainingController::class, 'raidPlainingStore'])->name('raid.plaining.store');
    Route::get('/raid-plaining/view/{id}', [RaidPlainingController::class, 'raidPlainingView'])->name('raid.plaining.view');
    Route::get('/raid-plaining/edit/{id}', [RaidPlainingController::class, 'raidPlainingEdit'])->name('raid.plaining.edit');
    Route::post('/raid-plaining/update/{id}', [RaidPlainingController::class, 'raidPlainingUpdate'])->name('raid.plaining.update');
    Route::get('/raid-plaining/destroy/{id}', [RaidPlainingController::class, 'raidPlainingDestroy'])->name('raid.plaining.destroy');
    Route::get('/raid-plaining/sort', [RaidPlainingController::class, 'sortRaidPlaining'])->name('raid.plaining.sort');
    Route::post('/raid-plaining/update-status/{id}', [RaidPlainingController::class, 'updateStatus']);


    // Raid Docomentation
    Route::get('/raid-documentation/index', [RaidDocController::class, 'raidDocIndex'])->name('raid.doc.index');
    Route::get('/raid-documentation/create', [RaidDocController::class, 'raidDocCreate'])->name('raid.doc.create');
    Route::post('/raid-documentation/store', [RaidDocController::class, 'raidDocStore'])->name('raid.doc.store');
    Route::get('/raid-documentation/view/{id}', [RaidDocController::class, 'raidDocView'])->name('raid.doc.view');
    Route::get('/raid-documentation/edit/{id}', [RaidDocController::class, 'raidDocEdit'])->name('raid.doc.edit');
    Route::post('/raid-documentation/update/{id}', [RaidDocController::class, 'raidDocUpdate'])->name('raid.doc.update');
    Route::get('/raid-documentation/destroy/{id}', [RaidDocController::class, 'raidDocDestroy'])->name('raid.doc.destroy');
    Route::get('/raid-documentation/sort', [RaidDocController::class, 'sortRaidDoc'])->name('raid.doc.sort');
    Route::post('/raid-documentation/update-status/{id}', [RaidDocController::class, 'updateStatus']);


    // Pending Destruction
    Route::get('/pending-destruction/index', [PendingDestructionController::class, 'pendingDestructionIndex'])->name('pending.destruction.index');
    Route::get('/pending-destruction/create', [PendingDestructionController::class, 'pendingDestructionCreate'])->name('pending.destruction.create');
    Route::post('/pending-destruction/store', [PendingDestructionController::class, 'pendingDestructionStore'])->name('pending.destruction.store');
    Route::get('/pending-destruction/view/{id}', [PendingDestructionController::class, 'pendingDestructionView'])->name('pending.destruction.view');
    Route::get('/pending-destruction/edit/{id}', [PendingDestructionController::class, 'pendingDestructionEdit'])->name('pending.destruction.edit');
    Route::post('/pending-destruction/update/{id}', [PendingDestructionController::class, 'pendingDestructionUpdate'])->name('pending.destruction.update');
    Route::get('/pending-destruction/destroy/{id}', [PendingDestructionController::class, 'pendingDestructionDestroy'])->name('pending.destruction.destroy');
    Route::get('/pending-destruction/sort', [PendingDestructionController::class, 'sortPendingDestruction'])->name('pending.destruction.sort');


    // Pending Destruction
    Route::get('/completed-destruction/index', [CompletedDestructionController::class, 'completedDestructionIndex'])->name('completed.destruction.index');
    Route::get('/completed-destruction/create', [CompletedDestructionController::class, 'completedDestructionCreate'])->name('completed.destruction.create');
    Route::post('/completed-destruction/store', [CompletedDestructionController::class, 'completedDestructionStore'])->name('completed.destruction.store');
    Route::get('/completed-destruction/view/{id}', [CompletedDestructionController::class, 'completedDestructionView'])->name('completed.destruction.view');
    Route::get('/completed-destruction/edit/{id}', [CompletedDestructionController::class, 'completedDestructionEdit'])->name('completed.destruction.edit');
    Route::post('/completed-destruction/update/{id}', [CompletedDestructionController::class, 'completedDestructionUpdate'])->name('completed.destruction.update');
    Route::get('/completed-destruction/destroy/{id}', [CompletedDestructionController::class, 'completedDestructionDestroy'])->name('completed.destruction.destroy');
    Route::get('/completed-destruction/sort', [CompletedDestructionController::class, 'sortCompletedDestruction'])->name('completed.destruction.sort');
    Route::post('/completed-destruction/update-status/{id}', [CompletedDestructionController::class, 'updateStatus']);

    // Currency

    Route::controller(CurrencyController::class)->prefix('currency')->as('currency.')->group(function () {
        Route::get('', 'currencyIndex')->name('index');
        Route::get('create', 'currencyCreate')->name('create');
        Route::post('store', 'currencyStore')->name('store');
        Route::get('show/{id}', 'currencyShow')->name('show');
        Route::get('edit/{id}', 'currencyEdit')->name('edit');
        Route::put('update/{id}', 'currencyUpdate')->name('update');
        Route::delete('destroy/{id}', 'currencyDestroy')->name('destroy');
        Route::post('/update-status/{id}', 'updateStatus');
        Route::get('/sort', 'sortCurrency')->name('sort');

    });


    Route::controller(ExpensesController::class)->prefix('expenses')->as('expenses.')->group(function () {
        Route::get('', 'expensesIndex')->name('index');
        Route::get('create', 'expensesCreate')->name('create');
        Route::post('store', 'expensesStore')->name('store');
        Route::get('show/{id}', 'expensesShow')->name('show');
        Route::get('edit/{id}', 'expensesEdit')->name('edit');
        Route::put('update/{id}', 'expensesUpdate')->name('update');
        Route::delete('destroy/{id}', 'expensesDestroy')->name('destroy');
        Route::post('/update-status/{id}', 'updateStatus');
        Route::get('/sort', 'sortExpenses')->name('sort');

    });

    Route::controller(InvoiceController::class)->prefix('invoice')->as('invoice.')->group(function () {
        Route::get('', 'invoiceIndex')->name('index');
        Route::get('create', 'invoiceCreate')->name('create');
        Route::post('store', 'invoiceStore')->name('store');
        Route::get('show/{id}', 'invoiceShow')->name('show');
        Route::get('edit/{id}', 'invoiceEdit')->name('edit');
        Route::put('update/{id}', 'invoiceUpdate')->name('update');
        Route::delete('destroy/{id}', 'invoiceDestroy')->name('destroy');
        Route::post('/update-status/{id}', 'updateStatus');
        Route::get('/sort', 'sortInvoice')->name('sort');
        Route::get('/get-auto-id-data/{id}', 'getAutoIdData')->name('get.invoice.data');

    });


    Route::controller(CaseReportController::class)->prefix('case-report')->as('case-report.')->group(function () {
        Route::get('', 'caseReportIndex')->name('index');
        Route::get('create', 'caseReportCreate')->name('create');
        Route::post('store', 'caseReportStore')->name('store');
        Route::get('show/{id}', 'caseReportShow')->name('show');
        Route::get('edit/{id}', 'caseReportEdit')->name('edit');
        Route::put('update/{id}', 'caseReportUpdate')->name('update');
        Route::delete('destroy/{id}', 'caseReportDestroy')->name('destroy');
        Route::post('/update-status/{id}', 'updateStatus');
        Route::get('/sort', 'sortCaseReport')->name('sort');

    });


    Route::controller(ClientReportController::class)->prefix('client-report')->as('client-report.')->group(function () {
        Route::get('', 'clientReportIndex')->name('index');
        Route::get('create', 'clientReportCreate')->name('create');
        Route::post('store', 'clientReportStore')->name('store');
        Route::get('show/{id}', 'clientReportShow')->name('show');
        Route::get('edit/{id}', 'clientReportEdit')->name('edit');
        Route::put('update/{id}', 'clientReportUpdate')->name('update');
        Route::delete('destroy/{id}', 'clientReportDestroy')->name('destroy');
        Route::post('/update-status/{id}', 'updateStatus');
        Route::get('/sort', 'sortClientReport')->name('sort');
        Route::get('/get-user-data/{id}', 'getUserData')->name('get.user.data');

    });

    Route::controller(FinanceReportController::class)->prefix('finance-report')->as('finance-report.')->group(function () {
        Route::get('', 'financeReportIndex')->name('index');
        Route::get('create', 'financeReportCreate')->name('create');
        Route::post('store', 'financeReportStore')->name('store');
        Route::get('show/{id}', 'financeReportShow')->name('show');
        Route::get('edit/{id}', 'financeReportEdit')->name('edit');
        Route::put('update/{id}', 'financeReportUpdate')->name('update');
        Route::delete('destroy/{id}', 'financeReportDestroy')->name('destroy');
        Route::post('/update-status/{id}', 'updateStatus');
        Route::get('/sort', 'sortFinanceReport')->name('sort');

    });


    // Finance
    Route::get('/finance/index', [FinanceController::class, 'financeIndex'])->name('finance.index');

    // Department
    Route::resource('department', DepartmentController::class);
    Route::post('/department/update-status/{id}', [DepartmentController::class, 'updateDepartmentStatus']);
    Route::get('/department-sort', [DepartmentController::class, 'sortDepartment'])->name('department.sort');



    // Sub Department
    Route::resource('sub-department', SubDepartmentController::class);
    Route::get('/sub-department-sort', [SubDepartmentController::class, 'sortSubDepartment'])->name('sub-department.sort');




    // Permission
    // Route::get('/permission/index', [PermissionController::class, 'permissionIndex'])->name('permission.index');
    Route::get('/permission/index', [PermissionController::class, 'permissionIndex'])->name('permission.index');
    Route::get('/permissions/create', [PermissionController::class, 'permissionCreate'])->name('permission.create');
    // Route::get('/permissions/edit/{user}', [PermissionController::class, 'permissionEdit'])->name('permission.edit');
    // Route::post('/permissions/update/{user}', [PermissionController::class, 'permissionupdate'])->name('permission.update');
    // Route::get('/permissions', [PermissionController::class, 'permissionIndex'])->name('permission.index');
    Route::post('/permissions/assign', [PermissionController::class, 'permissionAssign'])->name('permission.assign');
    Route::get('/permissions/user/{id}', [PermissionController::class, 'getUserPermissions']);
    Route::get('/get-user-permissions/{id}', [PermissionController::class, 'getPermissions']);
    Route::delete('/permission/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');


    // Role
    Route::resource('role', RoleController::class);
});

require __DIR__.'/auth.php';
