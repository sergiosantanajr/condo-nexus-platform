
import { Toaster } from "@/components/ui/toaster";
import { Toaster as Sonner } from "@/components/ui/sonner";
import { TooltipProvider } from "@/components/ui/tooltip";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import Index from "./pages/Index";
import NotFound from "./pages/NotFound";

const queryClient = new QueryClient();

const App = () => (
  <QueryClientProvider client={queryClient}>
    <TooltipProvider>
      <Toaster />
      <Sonner />
      <BrowserRouter>
        <Routes>
          {/* Main Website Routes */}
          <Route path="/" element={<Index />} />
          <Route path="/quemsomos" element={<Index />} /> {/* Placeholder - to be implemented */}
          <Route path="/servicos" element={<Index />} /> {/* Placeholder - to be implemented */}
          <Route path="/servicos/administracao" element={<Index />} /> {/* Placeholder - to be implemented */}
          <Route path="/servicos/consultoria" element={<Index />} /> {/* Placeholder - to be implemented */}
          <Route path="/servicos/manutencao" element={<Index />} /> {/* Placeholder - to be implemented */}
          <Route path="/servicos/assembleias" element={<Index />} /> {/* Placeholder - to be implemented */}
          <Route path="/servicos/seguranca" element={<Index />} /> {/* Placeholder - to be implemented */}
          <Route path="/servicos/atendimento" element={<Index />} /> {/* Placeholder - to be implemented */}
          <Route path="/blog" element={<Index />} /> {/* Placeholder - to be implemented */}
          <Route path="/contato" element={<Index />} /> {/* Placeholder - to be implemented */}
          <Route path="/privacidade" element={<Index />} /> {/* Placeholder - to be implemented */}
          <Route path="/termos" element={<Index />} /> {/* Placeholder - to be implemented */}

          {/* Portal Routes */}
          <Route path="/portal" element={<Index />} /> {/* Placeholder - to be implemented */}
          <Route path="/portal/cadastro" element={<Index />} /> {/* Placeholder - to be implemented */}
          <Route path="/portal/imoveis" element={<Index />} /> {/* Placeholder - to be implemented */}
          <Route path="/portal/ajuda" element={<Index />} /> {/* Placeholder - to be implemented */}

          {/* Admin Routes */}
          <Route path="/admin" element={<Index />} /> {/* Placeholder - to be implemented */}

          {/* Catch-all route */}
          <Route path="*" element={<NotFound />} />
        </Routes>
      </BrowserRouter>
    </TooltipProvider>
  </QueryClientProvider>
);

export default App;
