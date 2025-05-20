
import { Toaster } from "@/components/ui/toaster";
import { Toaster as Sonner } from "@/components/ui/sonner";
import { TooltipProvider } from "@/components/ui/tooltip";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Index from "./pages/Index";
import NotFound from "./pages/NotFound";
import ServicosPage from "./pages/ServicosPage";

const queryClient = new QueryClient();

const App = () => (
  <QueryClientProvider client={queryClient}>
    <TooltipProvider>
      <Toaster />
      <Sonner />
      <BrowserRouter>
        <Routes>
          {/* Rotas do Site Institucional */}
          <Route path="/" element={<Index />} />
          <Route path="/quemsomos" element={<Index />} /> {/* Placeholder - a ser implementado */}
          <Route path="/servicos" element={<ServicosPage />} />
          <Route path="/servicos/:tipo" element={<ServicosPage />} />
          <Route path="/blog" element={<Index />} /> {/* Placeholder - a ser implementado */}
          <Route path="/contato" element={<Index />} /> {/* Placeholder - a ser implementado */}
          <Route path="/privacidade" element={<Index />} /> {/* Placeholder - a ser implementado */}
          <Route path="/termos" element={<Index />} /> {/* Placeholder - a ser implementado */}

          {/* Rotas do Portal */}
          <Route path="/portal" element={<Index />} /> {/* Placeholder - a ser implementado */}
          <Route path="/portal/cadastro" element={<Index />} /> {/* Placeholder - a ser implementado */}
          <Route path="/portal/imoveis" element={<Index />} /> {/* Placeholder - a ser implementado */}
          <Route path="/portal/ajuda" element={<Index />} /> {/* Placeholder - a ser implementado */}
          <Route path="/portal/tickets" element={<Index />} /> {/* Placeholder - a ser implementado */}

          {/* Rotas do Admin */}
          <Route path="/admin" element={<Index />} /> {/* Placeholder - a ser implementado */}
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
