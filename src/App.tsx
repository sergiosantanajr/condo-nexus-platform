
import { Toaster } from "@/components/ui/toaster";
import { Toaster as Sonner } from "@/components/ui/sonner";
import { TooltipProvider } from "@/components/ui/tooltip";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
import Index from "./pages/Index";
import NotFound from "./pages/NotFound";
import ServicosPage from "./pages/ServicosPage";
import Install from "./pages/Install";
import AdminLogin from "./pages/AdminLogin";
import AdminDashboard from "./pages/AdminDashboard";
import PortalLogin from "./pages/PortalLogin";
import PortalCadastro from "./pages/PortalCadastro";
import PortalDashboard from "./pages/PortalDashboard";
import PortalTickets from "./pages/PortalTickets";
import BlogPage from "./pages/BlogPage";
import BlogPostPage from "./pages/BlogPostPage";
import ContatoPage from "./pages/ContatoPage";

const queryClient = new QueryClient();

// Verificar se o sistema já foi instalado
const isInstalled = localStorage.getItem("installed") === "true";

const App = () => (
  <QueryClientProvider client={queryClient}>
    <TooltipProvider>
      <Toaster />
      <Sonner />
      <BrowserRouter>
        <Routes>
          {/* Rota de Instalação */}
          <Route path="/install" element={isInstalled ? <Navigate to="/" /> : <Install />} />
          
          {/* Rotas do Site Institucional */}
          <Route path="/" element={<Index />} />
          <Route path="/quemsomos" element={<Index />} /> {/* Placeholder - a ser implementado */}
          <Route path="/servicos" element={<ServicosPage />} />
          <Route path="/servicos/:tipo" element={<ServicosPage />} />
          <Route path="/blog" element={<BlogPage />} />
          <Route path="/blog/:id" element={<BlogPostPage />} />
          <Route path="/contato" element={<ContatoPage />} />
          <Route path="/privacidade" element={<Index />} /> {/* Placeholder - a ser implementado */}
          <Route path="/termos" element={<Index />} /> {/* Placeholder - a ser implementado */}

          {/* Rotas do Portal */}
          <Route path="/portal" element={<PortalLogin />} />
          <Route path="/portal/cadastro" element={<PortalCadastro />} />
          <Route path="/portal/dashboard" element={<PortalDashboard />} />
          <Route path="/portal/tickets" element={<PortalTickets />} />
          <Route path="/portal/imoveis" element={<Index />} /> {/* Placeholder - a ser implementado */}
          <Route path="/portal/ajuda" element={<Index />} /> {/* Placeholder - a ser implementado */}

          {/* Rotas do Admin */}
          <Route path="/admin" element={<AdminLogin />} />
          <Route path="/admin/dashboard" element={<AdminDashboard />} />
          <Route path="/admin/blog" element={<Index />} /> {/* Placeholder - a ser implementado */}
          <Route path="/admin/tickets" element={<Index />} /> {/* Placeholder - a ser implementado */}
          <Route path="/admin/imoveis" element={<Index />} /> {/* Placeholder - a ser implementado */}

          {/* Rota para página não encontrada */}
          <Route path="*" element={<NotFound />} />
        </Routes>
      </BrowserRouter>
    </TooltipProvider>
  </QueryClientProvider>
);

export default App;
