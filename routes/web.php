<?php

use App\Livewire\Institutions\CreateInstitution;
use App\Livewire\Institutions\EditInstitution;
use App\Livewire\Institutions\ListInstitutions;
use App\Livewire\Registers\CreateRegister;
use App\Livewire\Registers\EditRegister;
use App\Livewire\Registers\ListRegisters;
use App\Livewire\Sectors\CreateSector;
use App\Livewire\Sectors\EditSector;
use App\Livewire\Sectors\ListSectors;
use App\Http\Controllers\PdfController; // Add this line
use App\Livewire\Categories\CreateCategory;
use App\Livewire\Categories\EditCategory;
use App\Livewire\Categories\ListCategories;
use App\Livewire\Plans\CreatePlan;
use App\Livewire\Plans\EditPlan;
use App\Livewire\Plans\ListPlans;
use App\Livewire\Subcategories\CreateSubcategory;
use App\Livewire\Subcategories\EditSubcategory;
use App\Livewire\Subcategories\ListSubcategories;
use App\Livewire\Strategies\CreateStrategy; // Add this line
use App\Livewire\Strategies\EditStrategy; // Add this line
use App\Livewire\Strategies\ListStrategies; // Add this line
use App\Livewire\ViewRegister;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::get('/', fn () => redirect('/login'));

Route::middleware('auth')->group(function () {

//Route::view('dashboard', 'dashboard')
  //  ->middleware(['auth', 'verified'])
  //  ->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

//--------------Sectors
Route::prefix('/sectors')->group(function () {
    Route::get('/index', ListSectors::class)->name('sectors.list-sectors')->middleware('can:viewAny,App\Models\Sector');
    Route::get('/create', CreateSector::class)->name('sectors.create-sector')->middleware('can:create,App\Models\Sector');
    Route::get('/{sector}/edit', EditSector::class)->name('sectors.edit-sector')->middleware('can:update,App\Models\Sector');
});

//--------------Institutions
Route::prefix('/institutions')->group(function () {
    Route::get('/index', ListInstitutions::class)->name('institutions.list-institutions')->middleware('can:viewAny,App\Models\Institution');
    Route::get('/create', CreateInstitution::class)->name('institutions.create-institution')->middleware('can:create,App\Models\Institution');
    Route::get('/{institution}/edit', EditInstitution::class)->name('institutions.edit-institution')->middleware('can:update,App\Models\Institution');
});

Route::prefix('/registers')->group(function () {
    Route::get('/index', ListRegisters::class)->name('registers.list-registers')->middleware('can:viewAny,App\Models\Register');
    Route::get('/create', CreateRegister::class)->name('registers.create-register')->middleware('can:create,App\Models\Register');
    Route::get('/{register}/edit', EditRegister::class)->name('registers.edit-register')->middleware('can:update,App\Models\Register');
    //Route::get('/(record)/pdf/download',[DownloadPdfController::class, 'download'])->name('register.pdf.download');
    // a pdf will be saved
});

Route::prefix('/plans')->group(function () {
    Route::get('/index', ListPlans::class)->name('plans.list-plans')->middleware('can:viewAny,App\Models\Plan');
    Route::get('/create', CreatePlan::class)->name('plans.create-plans')->middleware('can:create,App\Models\Plan');
    Route::get('/{plan}/edit', EditPlan::class)->name('plans.edit-plans')->middleware('can:update,App\Models\Plan');
    //Route::get('/(record)/pdf/download',[DownloadPdfController::class, 'download'])->name('register.pdf.download');
    // a pdf will be saved
});

Route::prefix('/categories')->group(function () {
    Route::get('/index', ListCategories::class)->name('categories.list-categories')->middleware('can:viewAny,App\Models\Category');
    Route::get('/create', CreateCategory::class)->name('categories.create-categories')->middleware('can:create,App\Models\Category');
    Route::get('/{category}/edit', EditCategory::class)->name('categories.edit-categories')->middleware('can:update,App\Models\Category');
    //Route::get('/(record)/pdf/download',[DownloadPdfController::class, 'download'])->name('register.pdf.download');
    // a pdf will be saved
});

Route::prefix('/subcategories')->group(function () {
    Route::get('/index', ListSubcategories::class)->name('subcategories.list-subcategories')->middleware('can:viewAny,App\Models\Subcategory');
    Route::get('/create', CreateSubcategory::class)->name('subcategories.create-subcategories')->middleware('can:create,App\Models\Subcategory');
    Route::get('/{subcategory}/edit', EditSubcategory::class)->name('subcategories.edit-subcategories')->middleware('can:update,App\Models\Subcategory');
    //Route::get('/(record)/pdf/download',[DownloadPdfController::class, 'download'])->name('register.pdf.download');
    // a pdf will be saved
});

Route::prefix('/strategies')->group(function () {
    Route::get('/index', ListStrategies::class)->name('strategies.list-strategies')->middleware('can:viewAny,App\Models\Strategy');
    Route::get('/create', CreateStrategy::class)->name('strategies.create-strategies')->middleware('can:create,App\Models\Strategy');
    Route::get('/{strategy}/edit', EditStrategy::class)->name('strategies.edit-strategies')->middleware('can:update,App\Models\Strategy');
});

Route::get('/registers/{register}/pdf', [PdfController::class, 'pdfinbrowser'])->name('browserpdf');
Route::get('registers/{register}', ViewRegister::class)->name('view-register');
});

require __DIR__.'/auth.php';
