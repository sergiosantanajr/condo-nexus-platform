
import { useState } from "react";

const WhatsAppButton = ({ phone = "5511999999999", message = "Olá, gostaria de mais informações sobre seus serviços!" }) => {
  const [isHovered, setIsHovered] = useState(false);
  
  const whatsappUrl = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
  
  return (
    <a
      href={whatsappUrl}
      target="_blank"
      rel="noopener noreferrer"
      className="fixed bottom-6 right-6 z-50 group"
      onMouseEnter={() => setIsHovered(true)}
      onMouseLeave={() => setIsHovered(false)}
    >
      <div className="flex items-center">
        {isHovered && (
          <div className="mr-2 bg-white py-2 px-4 rounded-full shadow-lg slide-up">
            <span className="text-gray-800 font-medium text-sm whitespace-nowrap">Fale conosco</span>
          </div>
        )}
        <div className="bg-green-500 hover:bg-green-600 w-14 h-14 rounded-full flex items-center justify-center shadow-lg transition-transform hover:scale-110">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="white"
            width="28"
            height="28"
          >
            <path d="M17.6 6.2c-1.5-1.5-3.4-2.3-5.5-2.3-4.3 0-7.8 3.5-7.8 7.8 0 1.4.4 2.7 1.1 3.9l-1.2 4.3 4.4-1.2c1.1.6 2.4 1 3.7 1h.003c4.3 0 7.8-3.5 7.8-7.8-.1-2.1-.9-4-2.3-5.5zm-5.5 11.9c-1.2 0-2.3-.3-3.3-.9l-.2-.1-2.3.6.6-2.2-.2-.2c-.6-1-1-2.2-1-3.4 0-3.6 2.9-6.5 6.5-6.5 1.7 0 3.4.7 4.6 1.9 1.2 1.2 1.9 2.8 1.9 4.6-.1 3.6-3 6.5-6.6 6.5zm3.5-4.8c-.2-.1-1.1-.6-1.3-.6-.2-.1-.3-.1-.4.1-.1.2-.5.6-.6.8-.1.1-.2.1-.4 0-.2-.1-.8-.3-1.5-.9-.5-.5-.9-1-1-1.2-.1-.2 0-.3.1-.4.1-.1.2-.2.3-.3.1-.1.1-.2.2-.3.1-.1 0-.2 0-.3 0-.1-.4-1-.5-1.4-.1-.4-.3-.3-.4-.3h-.4c-.1 0-.3.1-.5.2-.2.2-.6.6-.6 1.5s.6 1.7.7 1.8c.1.1 1.4 2.1 3.3 2.9.5.2.8.3 1.1.4.5.1.9.1 1.2.1.4-.1 1.1-.5 1.3-.9.2-.5.2-.8.1-.9-.1-.2-.2-.2-.4-.3z" />
          </svg>
        </div>
      </div>
    </a>
  );
};

export default WhatsAppButton;
