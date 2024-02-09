<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\BannerTextController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\V2\TransferController;
use App\Http\Controllers\V2\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });
require __DIR__ . '/amk.php';
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\User\WelcomeController::class, 'index'])->name('welcome');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');

//auth routes
Route::get('/login', [LoginController::class, 'userLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::get('/register', [LoginController::class, 'userRegister'])->name('register');

// Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth']], function () {

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'checkBanned']], function () {
  // Permissions
  Route::delete('permissions/destroy', [PermissionController::class, 'massDestroy'])->name('permissions.massDestroy');
  Route::resource('permissions', PermissionController::class);
  // Roles
  Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
  Route::resource('roles', RolesController::class);
  // Users
  Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
  Route::resource('users', UsersController::class);
  Route::put('users/{id}/ban', [UsersController::class, 'banUser'])->name('users.ban');
  Route::resource('profiles', ProfileController::class);
  Route::put('/super-admin-update-balance/{id}', [App\Http\Controllers\Admin\ProfileController::class, 'AdminUpdateBalance'])->name('admin-update-balance');
  // user profile route get method
  Route::put('/change-password', [ProfileController::class, 'newPassword'])->name('changePassword');
  // PhoneAddressChange route with auth id route with put method
  Route::put('/change-phone-address', [ProfileController::class, 'PhoneAddressChange'])->name('changePhoneAddress');
  Route::put('/change-kpay-no', [ProfileController::class, 'KpayNoChange'])->name('changeKpayNo');
  Route::put('/change-join-date', [ProfileController::class, 'JoinDate'])->name('addJoinDate');
  Route::resource('banners', BannerController::class);
  Route::resource('games', GameController::class);
  Route::resource('text', BannerTextController::class);
  Route::resource('/promotions', PromotionController::class);
  // master list route
  Route::get('/real-live-master-list', [App\Http\Controllers\Admin\Master\AdminCreateMasterController::class, 'index'])->name('real-live-master-list');
  // master create route
  Route::get('/real-live-master-create', [App\Http\Controllers\Admin\Master\AdminCreateMasterController::class, 'create'])->name('real-live-master-create');
  // master store route
  Route::post('/real-live-master-store', [App\Http\Controllers\Admin\Master\AdminCreateMasterController::class, 'store'])->name('real-live-master-store');
  // master edit route
  Route::get('/real-live-master-edit/{id}', [App\Http\Controllers\Admin\Master\AdminCreateMasterController::class, 'edit'])->name('real-live-master-edit');
  // master update route
  Route::put('/real-live-master-update/{id}', [App\Http\Controllers\Admin\Master\AdminCreateMasterController::class, 'update'])->name('real-live-master-update');
  // master show route
  Route::get('/real-live-master-show/{id}', [App\Http\Controllers\Admin\Master\AdminCreateMasterController::class, 'show'])->name('real-live-master-show');
  // master delete route
  Route::delete('/real-live-master-delete/{id}', [App\Http\Controllers\Admin\Master\AdminCreateMasterController::class, 'destroy'])->name('real-live-master-delete');
  // real master transfer route
  Route::get('/real-master-transfer/{id}', [App\Http\Controllers\Admin\Master\AdminCreateMasterController::class, 'transfer'])->name('real-master-transfer');
  // store real master transfer route
  Route::post('/real-master-transfer-store', [App\Http\Controllers\Admin\Master\AdminCreateMasterController::class, 'MastertransferStore'])->name('real-master-transfer-store');
  // real master cash out route
  Route::get('/real-master-cash-out/{id}', [App\Http\Controllers\Admin\Master\AdminCreateMasterController::class, 'transferCashOut'])->name('real-master-cash-out');
  // store real master cash out route
  Route::put('/real-master-cash-out-update/{id}', [App\Http\Controllers\Admin\Master\AdminCreateMasterController::class, 'MasterCashOutUpdate'])->name('real-master-cash-out-update');
  // agent list route
  Route::get('/agent-list', [App\Http\Controllers\Admin\Master\MasterController::class, 'index'])->name('agent-list');
  // agent create route
  Route::get('/agent-create', [App\Http\Controllers\Admin\Master\MasterController::class, 'create'])->name('agent-create');
  // agent store route
  Route::post('/agent-store', [App\Http\Controllers\Admin\Master\MasterController::class, 'store'])->name('agent-store');
  // agent edit route
  Route::get('/agent-edit/{id}', [App\Http\Controllers\Admin\Master\MasterController::class, 'edit'])->name('agent-edit');
  // agent update route
  Route::put('/agent-update/{id}', [App\Http\Controllers\Admin\Master\MasterController::class, 'update'])->name('agent-update');
  // agent show route
  Route::get('/agent-show/{id}', [App\Http\Controllers\Admin\Master\MasterController::class, 'show'])->name('agent-show');
  // agent delete route
  Route::delete('/agent-delete/{id}', [App\Http\Controllers\Admin\Master\MasterController::class, 'destroy'])->name('agent-delete');
  // agent transfer route
  Route::get('/agent-transfer/{id}', [App\Http\Controllers\Admin\Master\MasterController::class, 'transfer'])->name('agent-transfer');
  // store agent transfer route
  Route::post('/agent-transfer-store', [App\Http\Controllers\Admin\Master\MasterController::class, 'AgenttransferStore'])->name('agent-transfer-store');
  // agent cash out route
  Route::get('/agent-cash-out/{id}', [App\Http\Controllers\Admin\Master\MasterController::class, 'transferCashOut'])->name('agent-cash-out');
  // store agent cash out route
  Route::put('/agent-cash-out-store/{id}', [App\Http\Controllers\Admin\Master\MasterController::class, 'AgentCashOutStore'])->name('agent-cash-out-store');
  Route::resource('/promotions', PromotionController::class);
  // agent user list route
  Route::get('/agent-user-list', [App\Http\Controllers\Admin\Agent\AgentController::class, 'index'])->name('agent-user-list');
  // agent user create route
  Route::get('/agent-user-create', [App\Http\Controllers\Admin\Agent\AgentController::class, 'create'])->name('agent-user-create');
  // agent user store route
  Route::post('/agent-user-store', [App\Http\Controllers\Admin\Agent\AgentController::class, 'store'])->name('agent-user-store');
  // agent user edit route
  Route::get('/agent-user-edit/{id}', [App\Http\Controllers\Admin\Agent\AgentController::class, 'edit'])->name('agent-user-edit');
  // agent user update route
  Route::put('/agent-user-update/{id}', [App\Http\Controllers\Admin\Agent\AgentController::class, 'update'])->name('agent-user-update');
  // agent user show route
  Route::get('/agent-user-show/{id}', [App\Http\Controllers\Admin\Agent\AgentController::class, 'show'])->name('agent-user-show');
  // agent user delete route
  Route::delete('/agent-user-delete/{id}', [App\Http\Controllers\Admin\Agent\AgentController::class, 'destroy'])->name('agent-user-delete');
  // agent user transfer route
  Route::get('/agent-user-transfer/{id}', [App\Http\Controllers\Admin\Agent\AgentController::class, 'transfer'])->name('agent-user-transfer');
  // store agent user transfer route
  Route::post('/agent-user-transfer-store', [App\Http\Controllers\Admin\Agent\AgentController::class, 'AgentUsertransferStore'])->name('agent-user-transfer-store');
  // agent user cash out route
  Route::get('/agent-user-cash-out/{id}', [App\Http\Controllers\Admin\Agent\AgentController::class, 'transferCashOut'])->name('agent-user-cash-out');
  // store agent user cash out route
  Route::put('/agent-user-cash-out-store/{id}', [App\Http\Controllers\Admin\Agent\AgentController::class, 'AgentUserCashOutStore'])->name('agent-user-cash-out-store');
  // get all transfer log route
  Route::get('/get-all-admin-to-master-transfer-log', [App\Http\Controllers\Admin\Transfer\TransferLogController::class, 'AdminToMasterTransferLog'])->name('get-all-admin-master-transfer-log');
  // admin daily status transfer log route
  Route::get('/get-all-admin-to-master-daily-status-transfer-log', [App\Http\Controllers\Admin\Transfer\TransferLogController::class, 'AdminToMasterDailyStatusTransferLog'])->name('get-all-admin-master-daily-status-transfer-log');
  // admin monthly status transfer log route
  Route::get('/get-all-admin-to-master-monthly-status-transfer-log', [App\Http\Controllers\Admin\Transfer\TransferLogController::class, 'AdminToMasterMonthlyStatusTransferLog'])->name('get-all-admin-master-monthly-status-transfer-log');
  // get all total daily master to agent transfer log route
  Route::get('/get-all-master-to-agent-daily-status-transfer-log', [App\Http\Controllers\Admin\Transfer\TransferLogController::class, 'MasterToAgentDailyStatusTransferLog'])->name('get-all-master-agent-daily-status-transfer-log');
  // get all total monthly master to agent transfer log route
  Route::get('/get-all-master-to-agent-monthly-status-transfer-log', [App\Http\Controllers\Admin\Transfer\TransferLogController::class, 'MasterToAgentMonthlyStatusTransferLog'])->name('get-all-master-agent-monthly-status-transfer-log');
  // get all total daily agent to user transfer log route
  Route::get('/get-all-agent-to-user-daily-status-transfer-log', [App\Http\Controllers\Admin\Transfer\TransferLogController::class, 'AgentToUserDailyStatusTransferLog'])->name('get-all-agent-user-daily-status-transfer-log');
  // get all total monthly agent to user transfer log route
  Route::get('/get-all-agent-to-user-monthly-status-transfer-log', [App\Http\Controllers\Admin\Transfer\TransferLogController::class, 'AgentToUserMonthlyStatusTransferLog'])->name('get-all-agent-user-monthly-status-transfer-log');
  // get all master to agent transfer log route
  Route::get('/get-all-master-to-agent-transfer-log', [App\Http\Controllers\Admin\Transfer\TransferLogController::class, 'MasterToAgentTransferLog'])->name('get-all-master-agent-transfer-log');
  // get all agent to user transfer log route
  Route::get('/get-all-agent-to-user-transfer-log', [App\Http\Controllers\Admin\Transfer\TransferLogController::class, 'AgentToUserTransferLog'])->name('get-all-agent-user-transfer-log');
  // user management complete route

  Route::get("transfers", [TransferController::class, "index"]);

  Route::resource("users", UserController::class);
});

Route::get('football-index', [App\Http\Controllers\Football\FootballController::class, 'index']);
Route::get('football-maung', [App\Http\Controllers\Football\FootballController::class, 'maung']);
Route::get('football-bodygoal', [App\Http\Controllers\Football\FootballController::class, 'bodyGoal']);
Route::get('football-matches', [App\Http\Controllers\Football\FootballController::class, 'match']);
Route::get('football-moneylist', [App\Http\Controllers\Football\FootballController::class, 'moneyList']);
Route::get('football-goalresult', [App\Http\Controllers\Football\FootballController::class, 'goalResult']);
Route::get('football-moneychange', [App\Http\Controllers\Football\FootballController::class, 'moneyChange']);
