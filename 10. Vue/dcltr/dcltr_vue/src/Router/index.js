import { createRouter, createWebHashHistory } from "vue-router";
import SignUp from '@/Pages/SignUp';
import NotFoundPage from '@/Pages/NotFoundPage';
import ProfilePage from '@/Pages/ProfilePage/ProfilePage';
import MainPage from '@/Pages/MainPage/MainPage'
import LoginPage from '@/Pages/LoginPage/LoginPage'
import DashboardPage from '@/Pages/DashboardPage/DashboardPage'
import FormBuilderPage from '@/Pages/FormBuilder/FormBuilderPage'
import FormListPage from '@/Pages/FormBuilder/FormListPage'
import GeneralSetting from '@/Pages/GeneralSetting/GeneralSetting'
import CategoryManagement from '@/Pages/CategoryManagement/CategoryManagement'
import EditCategory from '@/Pages/CategoryManagement/EditCategory'
import PlansManagement from '@/Pages/PlansManagement/PlansManagement'
import MarketPlaceUsers from '@/Pages/MarketPlaceUsers/MarketPlaceUsers'
import ViewUser from '@/Pages/MarketPlaceUsers/ViewUser'
import StaffUsers from '@/Pages/StaffUsers/StaffUsers'
import InspectionAgents from '@/Pages/InspectionAgents/InspectionAgents'
import logisticsStaff from '@/Pages/logisticsStaff/logisticsStaff'
import ProductMarketPlace from '@/Pages/ProductMarketPlace/ProductMarketPlace'
import ShowProduct from '@/Pages/ProductMarketPlace/ShowProduct'
import Services from '@/Pages/Services/Services'
import ShowService from '@/Pages/Services/ShowService'
import Dispute from '@/Pages/Dispute/Dispute'
import Transaction from '@/Pages/Transaction'
import CustomerSupport from '@/Pages/CustomerSupport/CustomerSupport'
import ChangePassword from '@/Pages/ChangePassword/ChangePassword'
import MyProfile from '@/Pages/MyProfile/MyProfile'
import BankDetails from '@/Pages/BankDetails/Bankdetails'
import AddRoles from "@/Pages/AddRoles/AddRoles";
import ViewRoles from "@/Pages/ViewRoles/ViewRoles";
import AddAdmin from "@/Pages/AddAdmin/AddAdmin";
import EditAdmin from "@/Pages/AddAdmin/EditAdmin"
import ViewStaff from '@/Pages/StaffUsers/ViewStaff'
import ViewSection from '@/Pages/ViewSection/ViewSection';
import CreateSection from '@/Pages/CreateSection/CreateSection';
import ViewSectionDetail from '@/Pages/ViewSection/ViewSectionDetail'
import EditSection from '@/Pages/ViewSection/EditSection'
import EditPermission from '@/Pages/EditPermission/EditPermission'
import CreateTicket from '@/Pages/CustomerSupport/CreateTicket'
import ViewSpecificTicket from '@/Pages/CustomerSupport/ViewSpecificTicket'
import ReOpen from '@/Pages/CustomerSupport/ReOpen'
import ViewticketCategory from '@/Pages/TicketCaregory/ViewTicketCategory'
import CreateTicketCategory from '@/Pages/TicketCaregory/CreateTicketCategory'
import EditTicketCategory from '@/Pages/TicketCaregory/EditTicketCategory'
import SeeAllNotification from '@/Pages/Notification/SeeAllNotification'
import PromotionCampaigns from '@/Pages/PromotionCampaigns/PromotionCampaigns'
import CreateCampaignsProgram from '@/Pages/PromotionCampaigns/CreateCampaignsProgram'
import ViewCampaign from '@/Pages/PromotionCampaigns/ViewCampaign';
import EditPromotionCampaigns from '@/Pages/PromotionCampaigns/EditPromotionCampaigns';
// import BlankPage from '@/Pages/BlankPage/BlankPage'

const routes = [
    {
        path: '/',
        name: 'Main',
        component: MainPage,
        meta: {
            requiresAuth: false
        },
        children: [
            {
                path: 'profile',
                name: 'ProfilePage',
                component: ProfilePage,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'dashboard',
                name: 'Dashboard',
                component: DashboardPage,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'formbuilder',
                name: 'Formbuilder',
                component: FormListPage,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'transactions/:id',
                name: 'Transactions',
                component: Transaction,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'formbuilder/addForm',
                name: 'AddFormBuilder',
                component: FormBuilderPage,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'formbuilder/:id/edit',
                name: 'EditFormBuilder',
                component: FormBuilderPage,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'generalsetting',
                name: 'GeneralSetting',
                component: GeneralSetting,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'categorymanagement/:id/edit',
                name: 'ViewCategoryPage',
                component: CategoryManagement,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'categorymanagement/:id/edit',
                name: 'ViewCategoryPage',
                component: CategoryManagement,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'categorymanagement',
                name: 'CategoryManagement',
                component: CategoryManagement,
                meta: {
                    requiresAuth: false
                },
            },
            {
                path: 'plans',
                name: 'PlansManagement',
                component: PlansManagement,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'marketplaceusers',
                name: 'Marketplaceusers',
                component: MarketPlaceUsers,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'user/:id',
                name: 'ViewUser',
                component: ViewUser,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'staffusers',
                name: 'StaffUsers',
                component: StaffUsers,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'inspectionagents',
                name: 'InspectionAgents',
                component: InspectionAgents,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'logisticsstaff',
                name: 'logisticsStaff',
                component: logisticsStaff,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'productmarketplace',
                name: 'ProductMarketPlace',
                component: ProductMarketPlace,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'product/:id/:notificationId?',
                name: 'Product',
                component: ShowProduct,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'logisticsstaff',
                name: 'logisticsStaff',
                component: logisticsStaff,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'services',
                name: 'Services',
                component: Services,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'services/:id',
                name: 'ShowServices',
                component: ShowService,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'dispute',
                name: 'Dispute',
                component: Dispute,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'customersupport',
                name: 'CustomerSupport',
                component: CustomerSupport,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'changepassword',
                name: 'ChangePassword',
                component: ChangePassword,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'myprofile',
                name: 'MyProfile',
                component: MyProfile,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'bankdetails',
                name: 'bankDetails',
                component: BankDetails,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'addroles',
                name: 'AddRoles',
                component: AddRoles,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'viewroles',
                name: 'ViewRoles',
                component: ViewRoles,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'addadmin',
                name: 'AddAdmin',
                component: AddAdmin,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'viewstaff/:id',
                name: 'ViewStaff',
                component: ViewStaff,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'editadmin/:id',
                name: 'EditAdmin',
                component: EditAdmin,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'viewsection',
                name: 'ViewSection',
                component: ViewSection,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'createsection',
                name: 'CreateSection',
                component: CreateSection,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'viewsectiondetail/:id',
                name: 'ViewSectionDetail',
                component: ViewSectionDetail,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'editsection/:id',
                name: 'EditSection',
                component: EditSection,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'editpermission/:id',
                name: 'EditPermission',
                component: EditPermission,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'createticket',
                name: 'CreateTicket',
                component: CreateTicket,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'createticket',
                name: 'CreateTicket',
                component: CreateTicket,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'viewspecificticket/:id',
                name: 'ViewSpecificTicket',
                component: ViewSpecificTicket,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'viewticketcategory',
                name: 'ViewticketCategory',
                component: ViewticketCategory,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'createticketcategory',
                name: 'CreateTicketCategory',
                component: CreateTicketCategory,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'editticketcategory/:id',
                name: 'EditTicketCategory',
                component: EditTicketCategory,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'reopen/:id',
                name: 'ReOpen',
                component: ReOpen,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'seeAllNotification',
                name: 'SeeAllNotification',
                component: SeeAllNotification,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'promotioncampaigns',
                name: 'PromotionCampaigns',
                component: PromotionCampaigns,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'createcampaignsprogram',
                name: 'CreateCampaignsProgram',
                component: CreateCampaignsProgram,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'viewcampaign/:id',
                name: 'ViewCampaign',
                component: ViewCampaign,
                meta: {
                    requiresAuth: false
                }
            },
            {
                path: 'editpromotioncampaigns/:id',
                name: 'EditPromotionCampaigns',
                component: EditPromotionCampaigns,
                meta: {
                    requiresAuth: false
                }
            },
            
        ]
    },
    {
        path: '/login',
        name: 'Login',
        component: LoginPage,
        meta: {
            requiresUnauth: true
        }
    },
    {
        path: '/register',
        name: 'Register',
        component: SignUp,
        meta: {
            requiresUnauth: true
        }
    },
    {
        path: "/:url(.*)",
        name: "not-found",
        component: NotFoundPage
    }

];
const router = createRouter({
    history: createWebHashHistory(),
    routes
});

router.beforeEach((to, from) => {
    // console.log("from", from)
    // console.log("to", to)
    // to and from are both route objects. must call `next`.
    // if(to.path=="/"){
    //     return  "/login";
    // }   
})

export default router;
